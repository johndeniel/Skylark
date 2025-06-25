<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico" />
    <title>Skylark</title>
    
    <!-- Primary Meta Tags -->
    <meta name="description" content="Open canvas for quotes, notes, and poems. A great source of inspiration for expressive and creative writing" />
    <meta name="author" content="John Deniel Dela Peña" />
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="Skylark, quotes, notes, poems, creative writing, inspiration, expressive writing, writing canvas, poetry, journaling, creative expression, writing tools, digital notebook" />
    <meta name="theme-color" content="#1a202c" /> 
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="Skylark – Open Canvas for Creative Writing" />
    <meta property="og:description" content="Open canvas for quotes, notes, and poems. A great source of inspiration for expressive and creative writing" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://skylark-one.vercel.app" />
    <meta property="og:image" content="https://skylark-one.vercel.app/opengraph-image.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt" content="Skylark - Your open canvas for quotes, notes, and poems" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="Skylark" />
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Skylark – Open Canvas for Creative Writing" />
    <meta name="twitter:description" content="Open canvas for quotes, notes, and poems. A great source of inspiration for expressive and creative writing" />
    <meta name="twitter:image" content="https://skylark-one.vercel.app/opengraph-image.png" />
    <meta name="twitter:image:alt" content="Skylark - Your open canvas for quotes, notes, and poems" />
    <meta name="twitter:creator" content="@YourTwitterHandle" /> 
    <meta name="twitter:site" content="@YourTwitterHandle" /> 
    
    <!-- Links -->
    <link rel="icon" href="/favicon.ico" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="canonical" href="https://skylark-one.vercel.app" />
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "Skylark",
      "url": "https://skylark-one.vercel.app",
      "description": "Open canvas for quotes, notes, and poems. A great source of inspiration for expressive and creative writing",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://skylark-one.vercel.app/?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Person",
      "name": "John Deniel Dela Peña",
      "url": "https://skylark-one.vercel.app",
      "sameAs": [
        "https://linkedin.com/in/john-deniel-dela-pena",
        "https://github.com/johndeniel",
        "https://twitter.com/YourTwitterHandle"
      ],
      "jobTitle": "Full Stack Web Developer",
      "nationality": "Philippine"
    }
    </script>
    <meta name="format-detection" content="telephone=no" />
    
    {{-- Additional head content --}}
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>