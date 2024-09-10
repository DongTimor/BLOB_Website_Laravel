<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {

                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 240 10% 3.9%;
                --card: 0 0% 100%;
                --card-foreground: 240 10% 3.9%;
                --popover: 0 0% 100%;
                --popover-foreground: 240 10% 3.9%;
                --primary: 240 5.9% 10%;
                --primary-foreground: 0 0% 98%;
                --secondary: 240 4.8% 95.9%;
                --secondary-foreground: 240 5.9% 10%;
                --muted: 240 4.8% 95.9%;
                --muted-foreground: 240 3.8% 46.1%;
                --accent: 240 4.8% 95.9%;
                --accent-foreground: 240 5.9% 10%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 5.9% 90%;
                --input: 240 5.9% 90%;
                --ring: 240 5.9% 10%;
                --radius: 0.5rem;
            }

            .dark {
                --background: 240 10% 3.9%;
                --foreground: 0 0% 98%;
                --card: 240 10% 3.9%;
                --card-foreground: 0 0% 98%;
                --popover: 240 10% 3.9%;
                --popover-foreground: 0 0% 98%;
                --primary: 0 0% 98%;
                --primary-foreground: 240 5.9% 10%;
                --secondary: 240 3.7% 15.9%;
                --secondary-foreground: 0 0% 98%;
                --muted: 240 3.7% 15.9%;
                --muted-foreground: 240 5% 64.9%;
                --accent: 240 3.7% 15.9%;
                --accent-foreground: 0 0% 98%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 3.7% 15.9%;
                --input: 240 3.7% 15.9%;
                --ring: 240 4.9% 83.9%;
            }
        }
    </style>

</head>

<body>
    <div
        class="bg-black min-h-screen flex flex-col items-center justify-center text-center text-white relative">
        <div class="absolute top-4 left-4">
            <label
                style="font-size: 35px; font-family: cursive "
                class="text-bootstrap-sans">BLOB</label>
        </div>
        <div class="absolute top-4 right-4">
            <ul class="flex space-x-4">
                <li><a href="#" class="text-muted-foreground hover:text-white"style="font-family: cursive">About</a></li>
                <li><a href="#" class="text-muted-foreground hover:text-white"style="font-family: cursive">News</a></li>
                <li><a href="#" class="text-muted-foreground hover:text-white"style="font-family: cursive">Pricing</a></li>
                <li><a href="#" class="text-muted-foreground hover:text-white"style="font-family: cursive">Blog</a></li>
                <li><a href="#"
                        class="bg-secondary text-secondary-foreground px-4 py-2 rounded-lg hover:bg-secondary/80">Sign
                        Up</a></li>
            </ul>
        </div>
        <h1 class="text-5xl font-bold mb-4 " style="font-family: cursive">WELLCOME TO BLOB</h1>
        <p class="text-lg mb-6 max-w-lg mx-auto" style="font-family: cursive">
            BLOB là nền tảng mạng xã hội mới, nơi bạn có thể kết nối, chia sẻ và khám phá những điều thú vị trong cuộc
            sống.
        </p>


        <a href="/content"
            class="relative inline-block bg-accent text-accent-foreground px-6 py-2 rounded-lg transition overflow-hidden"
            id="read-more-btn">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-lg bg-accent opacity-75" ></span>
            <span class="relative" style="font-family: cursive">Start Now</span>
        </a>
        <div class="mt-12 text-sm text-muted-foreground "style="font-family: cursive">
            designed by <a href="#" class="text-white"style="font-family: cursive">Dong</a>
        </div>
    </div>

    <script>
        const readMoreBtn = document.getElementById('read-more-btn');
        readMoreBtn.addEventListener('mouseenter', () => {
            readMoreBtn.classList.remove('bg-accent', 'text-accent-foreground');
            readMoreBtn.classList.add('bg-primary', 'text-primary-foreground');
        });
        readMoreBtn.addEventListener('mouseleave', () => {
            readMoreBtn.classList.remove('bg-primary', 'text-primary-foreground');
            readMoreBtn.classList.add('bg-accent', 'text-accent-foreground');
        });
        readMoreBtn.addEventListener('click', () => {
            readMoreBtn.classList.remove('bg-primary', 'text-primary-foreground');
            readMoreBtn.classList.add('bg-destructive', 'text-destructive-foreground');
        });
    </script>
</body>

</html>