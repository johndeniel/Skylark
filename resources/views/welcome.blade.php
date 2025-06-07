<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Skylark</title>

    @vite('resources/css/app.css')
    
    <style>
      body {
        overflow: hidden;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
      }
      
      /* Custom animations */
      @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(3deg); }
      }
      
      @keyframes drift {
        0% { transform: translateX(0px) scale(1); }
        33% { transform: translateX(40px) scale(1.1); }
        66% { transform: translateX(-20px) scale(0.9); }
        100% { transform: translateX(0px) scale(1); }
      }
      
      @keyframes glow {
        0%, 100% { opacity: 0.2; filter: blur(40px); }
        50% { opacity: 0.5; filter: blur(60px); }
      }
      
      @keyframes morph {
        0%, 100% { border-radius: 60% 40% 30% 70%; }
        25% { border-radius: 30% 60% 70% 40%; }
        50% { border-radius: 70% 30% 40% 60%; }
        75% { border-radius: 40% 70% 60% 30%; }
      }
      
      @keyframes textShimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
      }
      
      @keyframes particleFloat {
        0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.3; }
        25% { transform: translateY(-15px) translateX(10px); opacity: 0.8; }
        50% { transform: translateY(-30px) translateX(-5px); opacity: 0.5; }
        75% { transform: translateY(-10px) translateX(15px); opacity: 0.9; }
      }
      
      .animate-float { animation: float 8s ease-in-out infinite; }
      .animate-drift { animation: drift 12s ease-in-out infinite; }
      .animate-glow { animation: glow 6s ease-in-out infinite; }
      .animate-morph { animation: morph 15s ease-in-out infinite; }
      .animate-spin-slow { animation: spin 25s linear infinite; }
      .animate-shimmer { 
        background: linear-gradient(90deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,0.8) 100%);
        background-size: 200% 100%;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShimmer 3s ease-in-out infinite;
      }
      .animate-particle { animation: particleFloat 4s ease-in-out infinite; }
    </style>
  </head>
  <body class="bg-gradient-to-br from-slate-950 via-purple-950 to-slate-900 relative w-screen h-screen">

    <!-- Enhanced abstract blobs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
      <!-- Primary blob - Large morphing -->
      <div class="absolute w-[45vw] h-[45vw] bg-gradient-to-br from-purple-400/40 via-pink-500/30 to-rose-600/20 top-[-15%] left-[-15%] animate-glow animate-morph"></div>

      <!-- Secondary blob - Spinning -->
      <div class="absolute w-[38vw] h-[38vw] bg-gradient-to-br from-blue-400/30 via-cyan-500/25 to-purple-600/20 top-[15%] right-[5%] animate-spin-slow" style="border-radius: 45% 55% 35% 65%;"></div>

      <!-- Tertiary blob - Floating -->
      <div class="absolute w-[55vw] h-[55vw] bg-gradient-to-br from-indigo-500/20 via-blue-600/15 to-teal-500/10 bottom-[-25%] left-[20%] animate-float" style="border-radius: 70% 30% 60% 40%;"></div>

      <!-- Accent blob - Drifting -->
      <div class="absolute w-[32vw] h-[32vw] bg-gradient-to-br from-yellow-400/25 via-orange-500/20 to-red-500/15 top-[55%] right-[-12%] animate-drift animate-morph"></div>

      <!-- Additional organic shapes -->
      <div class="absolute w-[25vw] h-[25vw] bg-gradient-to-br from-emerald-400/15 via-teal-500/10 to-cyan-600/8 top-[35%] left-[55%] animate-glow" style="border-radius: 80% 20% 45% 55%;"></div>
      
      <div class="absolute w-[28vw] h-[28vw] bg-gradient-to-br from-violet-500/12 via-purple-600/8 to-indigo-700/6 bottom-[5%] right-[35%] animate-float" style="border-radius: 35% 65% 25% 75%;"></div>

      <!-- Small accent elements -->
      <div class="absolute w-[15vw] h-[15vw] bg-gradient-to-br from-pink-300/20 to-purple-400/15 top-[25%] left-[75%] animate-morph" style="border-radius: 60% 40% 80% 20%;"></div>
    </div>

    <!-- Floating particles -->
    <div class="absolute inset-0 -z-5">
      <div class="absolute w-2 h-2 bg-white/40 rounded-full top-[20%] left-[10%] animate-particle" style="animation-delay: 0s;"></div>
      <div class="absolute w-1.5 h-1.5 bg-purple-300/50 rounded-full top-[40%] left-[80%] animate-particle" style="animation-delay: 1s;"></div>
      <div class="absolute w-2.5 h-2.5 bg-blue-300/40 rounded-full top-[70%] left-[30%] animate-particle" style="animation-delay: 2s;"></div>
      <div class="absolute w-1 h-1 bg-pink-200/60 rounded-full top-[60%] left-[90%] animate-particle" style="animation-delay: 0.5s;"></div>
      <div class="absolute w-2 h-2 bg-cyan-300/45 rounded-full top-[15%] left-[60%] animate-particle" style="animation-delay: 1.8s;"></div>
      <div class="absolute w-1.5 h-1.5 bg-yellow-300/50 rounded-full top-[80%] left-[70%] animate-particle" style="animation-delay: 2.5s;"></div>
    </div>

    <!-- Main content -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full">
      <!-- Brand name with enhanced styling -->
      <div class="text-center">
        <h1 class="text-9xl md:text-[12rem] lg:text-[14rem] font-black tracking-wider animate-shimmer drop-shadow-2xl">
          SKYLARK
        </h1>
        
        <!-- Decorative line under brand -->
        <div class="mt-8 flex justify-center">
          <div class="h-1 w-32 bg-gradient-to-r from-transparent via-white/60 to-transparent rounded-full animate-pulse"></div>
        </div>
      </div>

      <!-- Enhanced decorative elements -->
      <div class="flex space-x-6 mt-16">
        <div class="group">
          <div class="w-4 h-4 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full animate-bounce transform group-hover:scale-110 transition-transform duration-300" style="animation-delay: 0s;"></div>
        </div>
        <div class="group">
          <div class="w-4 h-4 bg-gradient-to-br from-purple-400 to-blue-500 rounded-full animate-bounce transform group-hover:scale-110 transition-transform duration-300" style="animation-delay: 0.3s;"></div>
        </div>
        <div class="group">
          <div class="w-4 h-4 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full animate-bounce transform group-hover:scale-110 transition-transform duration-300" style="animation-delay: 0.6s;"></div>
        </div>
        <div class="group">
          <div class="w-4 h-4 bg-gradient-to-br from-cyan-400 to-teal-500 rounded-full animate-bounce transform group-hover:scale-110 transition-transform duration-300" style="animation-delay: 0.9s;"></div>
        </div>
        <div class="group">
          <div class="w-4 h-4 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full animate-bounce transform group-hover:scale-110 transition-transform duration-300" style="animation-delay: 1.2s;"></div>
        </div>
      </div>
    </div>

    <!-- Ambient lighting overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-purple-900/10 pointer-events-none"></div>
    
    <!-- Subtle noise texture overlay -->
    <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=&quot;0 0 256 256&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cfilter id=&quot;noiseFilter&quot;%3E%3CfeTurbulence type=&quot;fractalNoise&quot; baseFrequency=&quot;0.9&quot; numOctaves=&quot;4&quot; stitchTiles=&quot;stitch&quot;/%3E%3C/filter%3E%3Crect width=&quot;100%25&quot; height=&quot;100%25&quot; filter=&quot;url(%23noiseFilter)&quot;/%3E%3C/svg%3E');"></div>

  </body>
</html>