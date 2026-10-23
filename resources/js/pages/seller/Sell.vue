<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount, nextTick, watch } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Uppy, UppyFile } from '@uppy/core';
import Dashboard from '@uppy/dashboard'
import XHRUpload from '@uppy/xhr-upload'
import { 
  Car, Camera, ClipboardList, DollarSign, 
  ChevronRight, ChevronLeft, Upload, Info,
  CheckCircle2, X, ShieldCheck, MapPin, 
  Settings2, Activity, Key, Fuel, Gauge
} from 'lucide-vue-next';
import SellerLayout from '@/layouts/Seller.vue';

import '@uppy/core/css/style.css'
import '@uppy/dashboard/css/style.css'

let uppy = null

const uploader = ref<HTMLElement | null>(null)

// clean up (IMPORTANT)
onBeforeUnmount(() => {
    if (uppy) {
        uppy.destroy()
    }
})

defineOptions({ layout: SellerLayout });

const props = defineProps({
    brands: Array,
    categories: Array,
    models: Array,
});

const currentStep = ref(1);

// --- Complete Schema Form State ---
const listingForm = useForm({
    // Step 1: Identity
    brand_id: '',
    vehicle_model_id: '',
    category_id: '',
    year: new Date().getFullYear(),
    vin: '',
    stock_number: '',
    
    // Step 2: Technical & Condition
    mileage: '',
    engine_type: '',
    transmission: 'Automatic',
    fuel_type: 'Gasoline',
    primary_damage: 'None',
    loss_type: 'Collision',
    title_status: 'Salvage',
    has_keys: 'yes',
    engin_start: 'yes',
    frame_damage: 'no',
    
    // Step 3: Aesthetics
    exterior_color: '',
    interior_color: '',
    vehicle_type: 'Sedan',
    drivetrain: 'AWD',
    location: '',
    
    // Step 4: Media
    image_url: null,
    additional_images: [],
    
    // Step 5: Pricing
    starting_bid: '',
    reserve_price: '',
    is_buy_now: '',
    description: '',
});

// Chained Dropdown Filter
const filteredModels = computed(() => {
    if (!listingForm.brand_id) return [];

    console.log(props)

    return props?.models?.filter(m => m.brand_id === listingForm.brand_id);
});

const steps = [
    { id: 1, name: 'Identity', icon: Car },
    { id: 2, name: 'Condition', icon: Activity },
    { id: 3, name: 'Specs', icon: Settings2 },
    { id: 4, name: 'Photos', icon: Camera },
    { id: 5, name: 'Pricing', icon: DollarSign },
];

const nextStep = () => { if (currentStep.value < 5) currentStep.value++; };
const prevStep = () => { if (currentStep.value > 1) currentStep.value--; };

watch(currentStep, async (step) => {
    if (step !== 4) return

    await nextTick()

    if (!uploader.value) return

    uppy = new Uppy({
        restrictions: {
            maxNumberOfFiles: 10,
            allowedFileTypes: ['image/*'],
        },
        autoProceed: false,
    })

    // ✅ Dashboard UI (better than DragDrop)
    uppy.use(Dashboard, {
        inline: true,
        target: uploader.value,
        proudlyDisplayPoweredByUppy: false,
    })

    // select listener
    uppy.on('files-added', (files: UppyFile<any, any>[]) => {
        listingForm.additional_images = files;
    });

    // ✅ Laravel upload endpoint
    uppy.use(XHRUpload, {
        endpoint: '/seller/upload-images',
        fieldName: 'images[]',
        formData: true,
    })

    uppy.on('complete', (result) => {
        console.log('Uploaded:', result.successful)
    })
})

</script>

<template>
    <Head title="Create Premium Listing" />

    <div class="min-h-screen bg-slate-50 py-16 px-4">
        <div class="max-w-5xl mx-auto">
            
            <div class="mb-16 max-w-3xl mx-auto">
                <div class="flex items-center justify-between relative">
                    <div class="absolute top-6 left-0 w-full h-0.5 bg-slate-200 -translate-y-1/2 z-0"></div>
                    <div class="absolute top-6 left-0 h-0.5 bg-blue-600 -translate-y-1/2 z-0 transition-all duration-700"
                         :style="{ width: ((currentStep - 1) / 4 * 100) + '%' }"></div>

                    <div v-for="step in steps" :key="step.id" class="relative z-10 flex flex-col items-center">
                        <div :class="[currentStep >= step.id ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 scale-110' : 'bg-white text-slate-300 border-2 border-slate-100']"
                             class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500">
                            <component :is="step.icon" :size="20" />
                        </div>
                        <span :class="currentStep >= step.id ? 'text-blue-600 font-black' : 'text-slate-300 font-bold'" 
                              class="absolute -bottom-8 text-[9px] uppercase tracking-widest whitespace-nowrap">
                            {{ step.name }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[4rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
                <div class="p-10 md:p-20">

                    <div v-if="currentStep === 1" class="space-y-10 animate-in">
                        <div class="text-center max-w-md mx-auto mb-10">
                            <h2 class="text-4xl font-black text-slate-900 italic uppercase tracking-tighter">Basic <span class="text-blue-600">Info</span></h2>
                            <p class="text-slate-400 font-medium mt-2">Start with the fundamental identity of the vehicle.</p>
                        </div>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="label-style">Make</label>
                                <select v-model="listingForm.brand_id" @change="listingForm.vehicle_model_id = ''" class="input-style">
                                    <option value="">Select Brand</option>
                                    <option v-for="b in brands" :key="b.id" :value="b.id">{{ b.name }}</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="label-style">Model</label>
                                <select v-model="listingForm.vehicle_model_id" :disabled="!listingForm.brand_id" class="input-style disabled:opacity-40">
                                    <option value="">Select Model</option>
                                    <option v-for="m in filteredModels" :key="m.id" :value="m.id">{{ m.name }}</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="label-style">VIN</label>
                                <input v-model="listingForm.vin" type="text" placeholder="17-Digit Number" class="input-style uppercase" />
                            </div>
                            <div class="space-y-2">
                                <label class="label-style">Year</label>
                                <input v-model="listingForm.year" type="number" class="input-style" />
                            </div>
                        </div>
                    </div>

                    <div v-if="currentStep === 2" class="space-y-10 animate-in">
                        <div class="grid md:grid-cols-2 gap-10">
                            <div class="bg-slate-50 p-8 rounded-[2.5rem] space-y-6">
                                <div class="space-y-3">
                                    <label class="label-style">Does Engine Run?</label>
                                    <div class="toggle-container">
                                        <button @click="listingForm.engin_start = 'yes'" type="button" :class="listingForm.engin_start === 'yes' ? 'toggle-active' : 'toggle-inactive'">Runs</button>
                                        <button @click="listingForm.engin_start = 'no'" type="button" :class="listingForm.engin_start === 'no' ? 'toggle-active-red' : 'toggle-inactive'">No Start</button>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="label-style">Keys Included?</label>
                                    <div class="toggle-container">
                                        <button @click="listingForm.has_keys = 'yes'" type="button" :class="listingForm.has_keys === 'yes' ? 'toggle-active' : 'toggle-inactive'">Yes</button>
                                        <button @click="listingForm.has_keys = 'no'" type="button" :class="listingForm.has_keys === 'no' ? 'toggle-active-red' : 'toggle-inactive'">No</button>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="label-style">Primary Damage</label>
                                    <select v-model="listingForm.primary_damage" class="input-style">
                                        <option>None</option>
                                        <option>Front End</option>
                                        <option>Rear End</option>
                                        <option>Mechanical</option>
                                        <option>Flood</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="label-style">Mileage</label>
                                    <input v-model="listingForm.mileage" type="text" class="input-style" placeholder="e.g. 120,500" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="currentStep === 3" class="space-y-10 animate-in">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm space-y-6">
                                <h3 class="font-black text-[10px] uppercase tracking-widest text-blue-600">Mechanical DNA</h3>
                                <div class="grid gap-4">
                                    <input v-model="listingForm.engine_type" type="text" placeholder="Engine (e.g. 2.0L Turbo)" class="input-style-compact" />
                                    <div class="grid grid-cols-2 gap-4">
                                        <select v-model="listingForm.fuel_type" class="input-style-compact"><option>Gasoline</option><option>Diesel</option><option>Electric</option></select>
                                        <select v-model="listingForm.drivetrain" class="input-style-compact"><option>AWD</option><option>RWD</option><option>FWD</option></select>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm space-y-6">
                                <h3 class="font-black text-[10px] uppercase tracking-widest text-rose-600">Aesthetics</h3>
                                <div class="grid gap-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <input v-model="listingForm.exterior_color" type="text" placeholder="Exterior Color" class="input-style-compact" />
                                        <input v-model="listingForm.interior_color" type="text" placeholder="Interior Color" class="input-style-compact" />
                                    </div>
                                    <select v-model="listingForm.vehicle_type" class="input-style-compact"><option>Sedan</option><option>Coupe</option><option>SUV</option></select>
                                </div>
                            </div>
                            <div class="md:col-span-2 bg-slate-900 rounded-[3rem] p-10 text-white flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="flex items-center gap-6">
                                    <ShieldCheck :size="40" class="text-blue-500" />
                                    <div>
                                        <h4 class="text-xl font-black">Structural Check</h4>
                                        <p class="text-slate-400 text-sm font-medium">Has the frame or chassis been compromised?</p>
                                    </div>
                                </div>
                                <div class="toggle-container-dark min-w-[300px]">
                                    <button @click="listingForm.frame_damage = 'no'" type="button" :class="listingForm.frame_damage === 'no' ? 'toggle-active-white' : 'toggle-inactive-dark'">Clear</button>
                                    <button @click="listingForm.frame_damage = 'yes'" type="button" :class="listingForm.frame_damage === 'yes' ? 'toggle-active-red' : 'toggle-inactive-dark'">Damage</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="currentStep === 4" class="space-y-10 animate-in min-h-[340px] flex itmes-center justify-center">
                        <div  ref="uploader" ></div>
                    </div>

                    <div v-if="currentStep === 5" class="space-y-10 animate-in text-center">
                        <div class="max-w-md mx-auto space-y-6">
                            <div class="bg-slate-100 rounded-[3rem] p-12 shadow-2xl text-slate-900">
                                <label class="label-style !text-blue-400 block mb-6">Reserve Price</label>
                                <div class="flex items-center justify-center gap-4 text-6xl font-black">
                                    <span class="text-gray-400">$</span>
                                    <input v-model="listingForm.reserve_price" type="number" class="bg-transparent border-none focus:ring-0 text-slate-800 w-full text-center outline-none" placeholder="0" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="px-12 py-10 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                    <button v-if="currentStep > 1" @click="prevStep" class="flex items-center gap-2 font-black text-slate-400 hover:text-slate-900 transition text-xs uppercase">
                        <ChevronLeft :size="18" /> Back
                    </button>
                    <div v-else></div>

                    <button @click="currentStep === 5 ? listingForm.post(route('addListing.post')) : nextStep()"
                            class="bg-blue-600 hover:bg-slate-900 text-white px-12 py-5 rounded-[2rem] font-black transition-all flex items-center gap-4 shadow-xl shadow-blue-100">
                        {{ currentStep === 5 ? 'Launch Auction' : 'Continue' }}
                        <ChevronRight :size="20" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@reference "tailwindcss";

.label-style {
    @apply text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-2;
}

.input-style {
    @apply w-full px-8 py-5 rounded-[2rem] border-slate-100 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 transition-all outline-none font-bold text-slate-700 border text-lg;
}

.input-style-compact {
    @apply w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-600/10 focus:border-blue-600 transition-all outline-none font-bold text-slate-700 border;
}

.toggle-container {
    @apply flex p-1.5 bg-slate-200/50 rounded-[1.8rem] h-[64px];
}

.toggle-active {
    @apply flex-1 bg-white shadow-md text-blue-600 rounded-[1.4rem] font-black uppercase text-[10px] tracking-widest transition-all;
}

.toggle-active-red {
    @apply flex-1 bg-white shadow-md text-rose-600 rounded-[1.4rem] font-black uppercase text-[10px] tracking-widest transition-all;
}

.toggle-inactive {
    @apply flex-1 text-slate-400 font-bold uppercase text-[9px] tracking-widest transition-all hover:text-slate-600;
}

.toggle-container-dark {
    @apply flex p-1 bg-white/10 rounded-2xl h-[58px] border border-white/5;
}

.toggle-active-white {
    @apply flex-1 bg-white text-slate-900 rounded-xl font-black uppercase text-[10px] tracking-widest;
}

.toggle-inactive-dark {
    @apply flex-1 text-slate-500 font-bold uppercase text-[9px] tracking-widest hover:text-white transition;
}

.animate-in {
    animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>