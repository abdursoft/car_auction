<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoBid | Premium Car Auctions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        .gradient-text {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <i class="fas fa-gavel text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-800">Auto<span class="text-blue-600">Bid</span></span>
                </div>
                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="#" class="hover:text-blue-600 transition">Auctions</a>
                    <a href="#" class="hover:text-blue-600 transition">Sell Your Car</a>
                    <a href="#" class="hover:text-blue-600 transition">How it Works</a>
                </div>
                <div class="flex items-center gap-4">
                    <button class="text-slate-600 font-medium px-4">Login</button>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-200">Register</button>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 z-10" 
                 x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
                 x-show="show" x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 -translate-x-10">
                <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    Drive Your Dream <br><span class="gradient-text">At Your Own Price</span>
                </h1>
                <p class="text-lg text-slate-600 mb-8 max-w-lg">
                    The most transparent car auction platform. Bid on verified luxury, classic, and daily drivers with full history reports.
                </p>
                <div class="flex gap-4">
                    <button class="bg-slate-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-slate-800 transition transform hover:-translate-y-1">Explore Auctions</button>
                    <button class="border border-slate-300 px-8 py-4 rounded-xl font-bold hover:bg-slate-100 transition">View Daily Drops</button>
                </div>
            </div>
            
            <div class="lg:w-1/2 mt-12 lg:mt-0 relative"
                 x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
                 x-show="show" x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 translate-x-10">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
                <img src="https://images.unsplash.com/photo-1614200024993-215600644155?auto=format&fit=crop&q=80&w=1000" 
                     alt="Sports Car" 
                     class="rounded-3xl shadow-2xl relative z-10 transform -rotate-2 hover:rotate-0 transition duration-500">
            </div>
        </div>
    </section>

    <section class="py-20 bg-white" x-data="{ filter: 'all' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Live Auctions</h2>
                    <p class="text-slate-500">Don't miss out on these active listings ending soon.</p>
                </div>
                <div class="flex bg-slate-100 p-1 rounded-lg">
                    <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow-sm' : ''" class="px-4 py-2 rounded-md text-sm font-medium transition">All</button>
                    <button @click="filter = 'luxury'" :class="filter === 'luxury' ? 'bg-white shadow-sm' : ''" class="px-4 py-2 rounded-md text-sm font-medium transition">Luxury</button>
                    <button @click="filter = 'classic'" :class="filter === 'classic' ? 'bg-white shadow-sm' : ''" class="px-4 py-2 rounded-md text-sm font-medium transition">Classic</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                            04h 22m Left
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">2023 Porsche 911 GT3</h3>
                        <p class="text-slate-500 text-sm mb-4">4.0L H6 • 1,200 miles • Miami, FL</p>
                        <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                            <div>
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-wider">Current Bid</p>
                                <p class="text-2xl font-black text-blue-600">$185,000</p>
                            </div>
                            <button class="bg-slate-900 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-600 transition">Bid Now</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4 bg-slate-900 text-white px-3 py-1 rounded-full text-xs font-bold">
                            Live Auction
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">1967 Ford Mustang</h3>
                        <p class="text-slate-500 text-sm mb-4">Manual • Restored • Austin, TX</p>
                        <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                            <div>
                                <p class="text-xs text-slate-400 uppercase font-bold tracking-wider">Current Bid</p>
                                <p class="text-2xl font-black text-blue-600">$42,500</p>
                            </div>
                            <button class="bg-slate-900 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-600 transition">Bid Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold">Why Choose AutoBid?</h2>
                <p class="text-slate-500 mt-2">We provide the most secure and transparent auction experience.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-blue-600"></i>
                    </div>
                    <h3 class="font-bold mb-2">Verified Sellers</h3>
                    <p class="text-sm text-slate-500">Every car is inspected and history verified before listing.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-bolt text-green-600"></i>
                    </div>
                    <h3 class="font-bold mb-2">Instant Transfers</h3>
                    <p class="text-sm text-slate-500">Automated paperwork and secure escrow payments.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-purple-600"></i>
                    </div>
                    <h3 class="font-bold mb-2">24/7 Support</h3>
                    <p class="text-sm text-slate-500">Dedicated auction experts to help you through the process.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-truck text-orange-600"></i>
                    </div>
                    <h3 class="font-bold mb-2">Nationwide Shipping</h3>
                    <p class="text-sm text-slate-500">Get your new car delivered right to your doorstep.</p>
                </div>
            </div>
        </div>
    </section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            <div class="lg:w-1/2">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=800" class="rounded-3xl shadow-2xl rotate-1">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold mb-8">How it Works</h2>
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                        <div>
                            <h4 class="font-bold">Find your vehicle</h4>
                            <p class="text-slate-500">Browse hundreds of daily auctions and filtered categories.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                        <div>
                            <h4 class="font-bold">Place your bid</h4>
                            <p class="text-slate-500">Set your maximum bid and let our system handle the rest.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                        <div>
                            <h4 class="font-bold">Win & Drive</h4>
                            <p class="text-slate-500">Once the hammer falls, follow our easy checkout process.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <h2 class="text-2xl font-bold mb-8">This Month's Top Bidders</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between bg-slate-800 p-4 rounded-xl border border-slate-700">
                        <div class="flex items-center gap-4">
                            <img src="https://i.pravatar.cc/100?img=1" class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-bold">Alex Johnson</p>
                                <p class="text-xs text-slate-400">4 Auctions Won</p>
                            </div>
                        </div>
                        <span class="text-blue-400 font-bold">$420k Spent</span>
                    </div>
                    <div class="flex items-center justify-between bg-slate-800 p-4 rounded-xl border border-slate-700">
                        <div class="flex items-center gap-4">
                            <img src="https://i.pravatar.cc/100?img=2" class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-bold">Sarah Williams</p>
                                <p class="text-xs text-slate-400">2 Auctions Won</p>
                            </div>
                        </div>
                        <span class="text-blue-400 font-bold">$185k Spent</span>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-bold mb-8">What our users say</h2>
                <div class="bg-blue-600 p-8 rounded-2xl relative">
                    <i class="fas fa-quote-left absolute top-4 right-8 text-blue-400 text-6xl opacity-30"></i>
                    <p class="text-lg italic mb-6">"Found my dream classic Corvette here. The bidding process was seamless, and the inspection report gave me total peace of mind."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/100?img=3" class="w-10 h-10 rounded-full border-2 border-white">
                        <div>
                            <p class="font-bold text-sm">Mark Davis</p>
                            <div class="text-yellow-400 text-xs">
                                <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-20">
            <div>
                <h2 class="text-3xl font-bold mb-4">Have Questions?</h2>
                <p class="text-slate-500 mb-8">Our team is ready to help you sell or bid on your next vehicle.</p>
                <form action="#" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" placeholder="First Name" class="bg-slate-50 border border-slate-200 p-4 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none">
                        <input type="email" placeholder="Email Address" class="bg-slate-50 border border-slate-200 p-4 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                    <textarea rows="4" placeholder="Your Message" class="w-full bg-slate-50 border border-slate-200 p-4 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none"></textarea>
                    <button class="bg-blue-600 text-white w-full py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">Send Message</button>
                </form>
            </div>
            
            <div class="flex flex-col justify-center">
                <h3 class="text-xl font-bold mb-8 text-center lg:text-left uppercase tracking-widest text-slate-400 text-sm">Official Partners</h3>
                <div class="grid grid-cols-2 gap-8 opacity-50 grayscale">
                    <div class="flex justify-center items-center h-16 bg-slate-50 rounded-xl p-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/BMW.svg" class="h-10">
                    </div>
                    <div class="flex justify-center items-center h-16 bg-slate-50 rounded-xl p-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/90/Mercedes-Benz_logo%2C_2010.svg" class="h-10">
                    </div>
                    <div class="flex justify-center items-center h-16 bg-slate-50 rounded-xl p-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6d/Volkswagen_logo_2019.svg" class="h-10">
                    </div>
                    <div class="flex justify-center items-center h-16 bg-slate-50 rounded-xl p-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/Ford_logo_flat.svg" class="h-10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="bg-white border-b border-slate-200 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex text-sm font-medium text-slate-500">
            <a href="/" class="hover:text-blue-600">Home</a>
            <span class="mx-2">/</span>
            <a href="/auctions" class="hover:text-blue-600">Auctions</a>
            <span class="mx-2">/</span>
            <span class="text-slate-900">2023 Porsche 911 GT3</span>
        </nav>
    </div>
</div>

<main class="py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div x-data="{ activeImage: 'img1' }" class="bg-white p-4 rounded-3xl shadow-sm border border-slate-200">
                    <div class="aspect-video rounded-2xl overflow-hidden bg-slate-100 mb-4">
                        <img x-show="activeImage === 'img1'" src="https://images.unsplash.com/photo-1614200024993-215600644155?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover">
                        <img x-show="activeImage === 'img2'" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover" x-cloak>
                        <img x-show="activeImage === 'img3'" src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover" x-cloak>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <button @click="activeImage = 'img1'" :class="activeImage === 'img1' ? 'ring-2 ring-blue-600' : ''" class="rounded-lg overflow-hidden h-24">
                            <img src="https://images.unsplash.com/photo-1614200024993-215600644155?auto=format&fit=crop&q=80&w=300" class="w-full h-full object-cover">
                        </button>
                        <button @click="activeImage = 'img2'" :class="activeImage === 'img2' ? 'ring-2 ring-blue-600' : ''" class="rounded-lg overflow-hidden h-24">
                            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=300" class="w-full h-full object-cover">
                        </button>
                        <button @click="activeImage = 'img3'" :class="activeImage === 'img3' ? 'ring-2 ring-blue-600' : ''" class="rounded-lg overflow-hidden h-24">
                            <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&q=80&w=300" class="w-full h-full object-cover">
                        </button>
                        <div class="relative rounded-lg overflow-hidden h-24 bg-slate-900 flex items-center justify-center text-white font-bold cursor-pointer hover:bg-slate-800 transition">
                            <span>+12 Photos</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                    <h2 class="text-2xl font-bold mb-6">Vehicle Specifications</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-y-8 gap-x-4">
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Engine</p>
                            <p class="text-slate-900 font-bold">4.0L Flat-6</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Transmission</p>
                            <p class="text-slate-900 font-bold">7-Speed PDK</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Mileage</p>
                            <p class="text-slate-900 font-bold">1,245 mi</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Drive Type</p>
                            <p class="text-slate-900 font-bold">RWD</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Exterior Color</p>
                            <p class="text-slate-900 font-bold">Shark Blue</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Interior Color</p>
                            <p class="text-slate-900 font-bold">Black / Blue Stitch</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">VIN</p>
                            <p class="text-slate-900 font-bold">WP0AA2A9XPS2...</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Location</p>
                            <p class="text-slate-900 font-bold">Miami, FL</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                    <h2 class="text-2xl font-bold mb-4">Auction Description</h2>
                    <article class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        <p>This 2023 Porsche 911 GT3 is finished in Shark Blue over a Black leather and Race-Tex interior. Powered by a 4.0-liter flat-six paired with a seven-speed PDK dual-clutch transaxle, features include the Chrono Package, a front-axle lift system, and LED headlights in black...</p>
                        <ul class="list-disc pl-5 mt-4 space-y-2">
                            <li>Clean CARFAX Report</li>
                            <li>Ceramic Composite Brakes (PCCB)</li>
                            <li>Full Front PPF (Paint Protection Film)</li>
                        </ul>
                    </article>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-200 sticky top-24">
                    <div class="mb-6">
                        <h1 class="text-3xl font-black text-slate-900 mb-2">2023 Porsche 911 GT3</h1>
                        <div class="flex items-center gap-2">
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">PREMIUM</span>
                            <span class="text-slate-400 text-sm">Listing #44029</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-6 mb-6">
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <p class="text-slate-500 text-sm font-medium">Current Bid</p>
                                <p class="text-4xl font-black text-blue-600">$185,500</p>
                            </div>
                            <div class="text-right">
                                <p class="text-slate-500 text-sm font-medium">Time Left</p>
                                <p class="text-xl font-bold text-red-600">02:45:12</p>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" placeholder="Enter amount" class="w-full bg-white border-2 border-slate-100 p-4 pl-8 rounded-xl focus:border-blue-600 outline-none transition font-bold text-lg">
                        </div>
                        <button class="w-full bg-blue-600 text-white py-4 rounded-xl font-black text-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200 transform active:scale-95">
                            PLACE BID
                        </button>
                        <p class="text-center text-xs text-slate-400">Minimum bid increment: $500</p>
                    </div>

                    <hr class="my-8 border-slate-100">

                    <div>
                        <h3 class="font-bold text-slate-900 mb-4 flex justify-between">
                            Recent Bids
                            <span class="text-blue-600 text-sm font-medium cursor-pointer">View All</span>
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/100?img=12" class="w-8 h-8 rounded-full">
                                    <span class="font-bold">j_car_enthusiast</span>
                                </div>
                                <span class="font-bold">$185,500</span>
                            </div>
                            <div class="flex items-center justify-between text-sm opacity-60">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/100?img=8" class="w-8 h-8 rounded-full">
                                    <span class="font-bold">speed_demon</span>
                                </div>
                                <span class="font-bold">$185,000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200 flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=33" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold">Seller</p>
                        <p class="font-bold text-slate-900">Miami Exotic Collections</p>
                        <div class="flex text-yellow-400 text-xs">
                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star text-slate-200"></i>
                            <span class="ml-2 text-slate-500 font-medium">(48 deals)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<div class="bg-gray-100 min-h-screen">
    <div class="bg-white border-b border-gray-200 shadow-sm py-4">
        <div class="max-w-[1400px] mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold text-slate-800">Insurance Auctions</h1>
            <div class="flex items-center gap-4 text-sm">
                <span class="text-gray-500 font-bold">527,970 VEHICLES FOUND</span>
                <select class="bg-gray-50 border border-gray-300 rounded px-3 py-1 text-xs font-bold focus:ring-1 focus:ring-blue-500">
                    <option>Time: Ending Soonest</option>
                    <option>Year: Newest First</option>
                    <option>Price: Lowest First</option>
                </select>
            </div>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-4 py-6 flex gap-6">
        
        <aside class="w-72 flex-shrink-0 hidden lg:block">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm sticky top-24">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-slate-800 rounded-t-lg">
                    <span class="text-white font-bold text-sm">SEARCH FILTERS</span>
                    <button class="text-xs text-blue-300 hover:underline">Clear All</button>
                </div>
                
                <div class="p-4 space-y-4 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1">Keyword Search</label>
                        <input type="text" placeholder="Lot #, Model, or VIN" class="w-full text-sm border border-gray-300 rounded p-2 outline-none focus:border-blue-500">
                    </div>

                    <div x-data="{ open: true }" class="border-b border-gray-100 pb-2">
                        <button @click="open = !open" class="flex justify-between w-full text-sm font-bold text-gray-700 py-2">
                            MAKE <i class="fas" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open" class="space-y-1 mt-1">
                            <label class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer">
                                <input type="checkbox" class="mr-2"> FORD (74,508)
                            </label>
                            <label class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer">
                                <input type="checkbox" class="mr-2"> TOYOTA (74,379)
                            </label>
                            <label class="flex items-center text-xs text-gray-600 hover:text-blue-600 cursor-pointer">
                                <input type="checkbox" class="mr-2"> HONDA (57,234)
                            </label>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="border-b border-gray-100 pb-2">
                        <button @click="open = !open" class="flex justify-between w-full text-sm font-bold text-gray-700 py-2">
                            DAMAGE TYPE <i class="fas" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                        <div x-show="open" class="space-y-1 mt-1">
                            <label class="flex items-center text-xs text-gray-600">
                                <input type="checkbox" class="mr-2"> FRONT END
                            </label>
                            <label class="flex items-center text-xs text-gray-600">
                                <input type="checkbox" class="mr-2"> WATER/FLOOD
                            </label>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <button class="w-full bg-blue-600 text-white font-bold py-2 rounded shadow-md hover:bg-blue-700 transition uppercase text-sm tracking-tighter">
                        Apply Filters
                    </button>
                </div>
            </div>
        </aside>

        <section class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition group">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover">
                        <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">
                            2 DAYS LEFT
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-[11px] p-2 font-bold backdrop-blur-sm">
                            2021 TOYOTA VENZA • 21,815 MILES
                        </div>
                    </div>

                    <div class="p-3">
                        <div class="grid grid-cols-2 gap-x-2 gap-y-1 text-[11px] mb-3">
                            <div class="flex justify-between border-b border-gray-50 pb-1">
                                <span class="text-gray-400 font-bold uppercase">Lot #:</span>
                                <span class="text-gray-700 font-bold">I44541650</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-50 pb-1">
                                <span class="text-gray-400 font-bold uppercase">Location:</span>
                                <span class="text-blue-600 font-bold">Elkton, MD</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-50 pb-1">
                                <span class="text-gray-400 font-bold uppercase">Damage:</span>
                                <span class="text-red-500 font-bold uppercase">Side</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-50 pb-1">
                                <span class="text-gray-400 font-bold uppercase">Drive:</span>
                                <span class="text-gray-700 font-bold uppercase">AWD</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-50 pb-1">
                                <span class="text-gray-400 font-bold uppercase">Fuel:</span>
                                <span class="text-gray-700 font-bold uppercase">Hybrid</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-50 pb-1">
                                <span class="text-gray-400 font-bold uppercase">Title:</span>
                                <span class="text-orange-600 font-bold uppercase">Salvage</span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button class="flex-1 bg-green-600 text-white text-xs font-black py-2 rounded hover:bg-green-700 transition">
                                BID NOW
                            </button>
                            <button class="px-3 bg-gray-100 text-gray-600 border border-gray-200 rounded hover:bg-gray-200 transition">
                                <i class="fas fa-phone-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover">
                        <div class="absolute top-2 left-2 bg-slate-900 text-white text-[10px] font-bold px-2 py-1 rounded">
                            ENDING SOON
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-blue-600/90 text-white text-[11px] p-2 font-bold flex justify-between">
                            <span>2011 RAM 2500</span>
                            <span class="bg-white text-blue-600 px-1 rounded uppercase">Runs & Drives</span>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="grid grid-cols-2 gap-x-2 gap-y-1 text-[11px] mb-3">
                            <div class="flex justify-between border-b border-gray-50 pb-1"><span class="text-gray-400 font-bold uppercase">Lot #:</span><span class="text-gray-700 font-bold">I44318661</span></div>
                            <div class="flex justify-between border-b border-gray-50 pb-1"><span class="text-gray-400 font-bold uppercase">Location:</span><span class="text-blue-600 font-bold">Nephi, UT</span></div>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 bg-blue-600 text-white text-xs font-black py-2 rounded hover:bg-blue-700 transition">
                                BUY NOW $7,500
                            </button>
                            <button class="flex-1 bg-green-600 text-white text-xs font-black py-2 rounded hover:bg-green-700 transition">
                                BID NOW
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-10 flex justify-center items-center gap-1">
                <button class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded font-bold text-sm">1</button>
                <button class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded font-bold text-sm hover:bg-gray-50">2</button>
                <button class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded font-bold text-sm hover:bg-gray-50">3</button>
                <span class="px-2 text-gray-400">...</span>
                <button class="w-8 h-8 flex items-center justify-center bg-white border border-gray-200 text-gray-600 rounded font-bold text-sm hover:bg-gray-50">21,999</button>
            </div>
        </section>

    </div>
</div>

<footer class="bg-slate-900 py-12 border-t border-slate-800 text-center">
    <p class="text-slate-500">© 2026 AutoBid Auction Platform. Built with Laravel & Tailwind.</p>
</footer>

</body>
</html>