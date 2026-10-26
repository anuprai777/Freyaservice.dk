<x-public-layout>
    @php
        $isEn = app()->getLocale() === 'en';
    @endphp

    <x-slot name="title">{{ $isEn ? 'About Us - The Story Behind Freya Service ApS' : 'Om os - Historien bag Freya Service ApS' }}</x-slot>
    <x-slot name="metaDescription">{{ $isEn ? 'The story behind Freya Service ApS: Built on 16 years of hands-on chef experience, driven by understanding, and inspired by people.' : 'Historien bag Freya Service ApS: Bygget på 16 års praktisk erfaring som kok i restaurationsbranchen. Vi sætter det rette menneske på det rette sted.' }}</x-slot>

    <style>
        /* Snake Journey Winding Ribbon */
        .journey-ribbon-left {
            position: relative;
            border-left: 16px solid #1E4742;
            border-bottom: 16px solid #1E4742;
            border-top: 16px solid #1E4742;
            border-right: none;
            border-top-left-radius: 64px;
            border-bottom-left-radius: 64px;
        }

        .journey-ribbon-right {
            position: relative;
            border-right: 16px solid #1E4742;
            border-bottom: 16px solid #1E4742;
            border-top: 16px solid #1E4742;
            border-left: none;
            border-top-right-radius: 64px;
            border-bottom-right-radius: 64px;
        }

        .journey-connector-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 16px;
            background-color: #1E4742;
        }
    </style>

    <!-- Hero Header -->
    <section class="bg-navy text-white py-14 sm:py-18 px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-image:radial-gradient(rgba(246,241,233,0.07) 1.5px,transparent 0);background-size:24px 24px;">
        <!-- Ambient decorative blurs -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-burgundy/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-teal/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mb-4 leading-tight">
                    {{ $isEn ? 'Built on Experience, Driven by Understanding, and Inspired by People' : 'Bygget på erfaring, drevet af forståelse og inspireret af mennesker' }}
                </h1>
                <p class="text-base sm:text-lg text-sand-200 leading-relaxed max-w-3xl mx-auto">
                    {{ $isEn
                        ? 'After 16 years of working as a chef in the hospitality industry, I realized something important: successful service is not just about having enough people. It is about having the right people in the right place.'
                        : 'Efter 16 år som kok i restaurationsbranchen indså jeg noget afgørende: succesfuld service handler ikke kun om at have folk nok. Det handler om at have de rette mennesker på det rette sted.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 6px Brand Section Divider (Burgundy, Teal, Mist) -->
    <div class="brand-divider">
        <div class="brand-divider-burgundy"></div>
        <div class="brand-divider-teal"></div>
        <div class="brand-divider-mist"></div>
    </div>

    <!-- Main Content Container with The Journey Story -->
    <main class="py-16 sm:py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Title Centered (Matching reference screenshot) -->
            <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-navy tracking-tight mb-3">
                    {{ $isEn ? 'The Freya Service Journey Story' : 'Rejsen bag Freya Service ApS' }}
                </h2>
                <p class="text-sm sm:text-base text-ink/75 leading-relaxed max-w-2xl mx-auto">
                    {{ $isEn
                        ? 'Built on 16 years of practical culinary experience and a human-first approach to staffing. Explore the journey behind connecting businesses and temporary staff with care.'
                        : 'Bygget på 16 års praktisk erfaring fra restaurationsbranchen og en menneskelig tilgang til vikarservice. Oplev rejsen fra køkkengulvet til landsdækkende bemanding.' }}
                </p>
            </div>

            <!-- DESKTOP SNAKE JOURNEY RIBBON (Winding continuous S-curve layout) -->
            <div class="hidden md:block max-w-5xl mx-auto">

                <!-- ROW 1: Image Left, Text Right (Ribbon curves Left) -->
                <div class="grid grid-cols-2 gap-0 relative">
                    <!-- Left Column with U-Ribbon -->
                    <div class="journey-ribbon-left p-4 sm:p-5 pr-2">
                        <!-- Top starting cap (ends smoothly above image as in screenshot) -->
                        <div class="absolute -top-[16px] left-[70%] right-[-1px] h-[16px] bg-white z-10 pointer-events-none"></div>
                        <div class="absolute -top-[16px] left-[70%] w-5 h-[16px] bg-[#1E4742] rounded-r-full z-20 pointer-events-none"></div>

                        <div class="rounded-[28px] overflow-hidden shadow-md h-[300px] lg:h-[320px]">
                            <img
                                src="{{ asset('images/chef-grill-steaks.jpg') }}"
                                alt="{{ $isEn ? 'Chef at work in busy kitchen' : 'Kok i arbejde i køkkenet' }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                width="640"
                                height="420"
                            >
                        </div>
                    </div>

                    <!-- Right Column with Milestone Text -->
                    <div class="relative flex flex-col justify-center px-8 lg:px-12 py-6">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309] shadow-2xs mb-4">
                            <x-heroicon-o-fire class="w-5 h-5 text-[#B45309]" />
                        </div>
                        <h3 class="text-2xl font-black text-navy mb-3 tracking-tight">
                            {{ $isEn ? 'From Humble Beginnings' : 'Fra køkkengulvet: 16 års erfaring' }}
                        </h3>
                        <p class="text-sm text-ink/80 leading-relaxed max-w-md">
                            {{ $isEn
                                ? 'After 16 years of working as a chef in the hospitality industry, I realized something important: successful service is not just about having enough people. It is about having the right people in the right place. Throughout my career in different kitchens, hotels, and restaurants, I experienced firsthand the challenges businesses face every day.'
                                : 'Efter 16 år som kok i restaurationsbranchen indså jeg noget afgørende: succesfuld service handler ikke kun om at have folk nok. Det handler om at have de rette mennesker på det rette sted. Gennem min karriere i forskellige køkkener, hoteller og restauranter oplevede jeg på nærmeste hold presset ved at drive en travl forretning.' }}
                        </p>

                        <!-- Connector along bottom to meet Row 2 -->
                        <div class="journey-connector-bottom"></div>
                    </div>
                </div>

                <!-- ROW 2: Text Left, Image Right (Ribbon curves Right) -->
                <div class="grid grid-cols-2 gap-0 relative -mt-[16px]">
                    <!-- Left Column with Milestone Text -->
                    <div class="relative flex flex-col justify-center px-8 lg:px-12 py-6">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309] shadow-2xs mb-4">
                            <x-heroicon-o-light-bulb class="w-5 h-5 text-[#B45309]" />
                        </div>
                        <h3 class="text-2xl font-black text-navy mb-3 tracking-tight">
                            {{ $isEn ? 'Understanding the Industry from the Inside' : 'Forståelse af branchen indefra' }}
                        </h3>
                        <p class="text-sm text-ink/80 leading-relaxed max-w-md">
                            {{ $isEn
                                ? 'Having spent 16 years on the operational side, I understand that every workplace is different. A busy hotel kitchen does not have the same requirements as a small restaurant. A corporate canteen operates differently from an à la carte restaurant. Simply sending an available worker to fill an empty shift was never the solution. The real solution is understanding the workplace, its culture, and finding the person who truly fits.'
                                : 'Efter 16 år på den operationelle side forstår jeg, at ingen arbejdspladser er ens. Et travlt hotelkøkken stiller ikke de samme krav som en lille restaurant. En kantine fungerer anderledes end en à la carte-restaurant. At sende en tilfældig person ud til en vagt var aldrig løsningen. Den virkelige løsning er at forstå arbejdspladsen og finde det menneske, der reelt passer ind.' }}
                        </p>

                        <!-- Connector along bottom to meet Row 3 -->
                        <div class="journey-connector-bottom"></div>
                    </div>

                    <!-- Right Column with U-Ribbon -->
                    <div class="journey-ribbon-right p-4 sm:p-5 pl-2">
                        <div class="rounded-[28px] overflow-hidden shadow-md h-[300px] lg:h-[320px]">
                            <img
                                src="{{ asset('images/founder-portrait.jpg') }}"
                                alt="{{ $isEn ? 'Founder of Freya Service ApS' : 'Stifter af Freya Service ApS' }}"
                                class="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500"
                                width="640"
                                height="420"
                            >
                        </div>
                    </div>
                </div>

                <!-- ROW 3: Image Left, Text Right (Ribbon curves Left) -->
                <div class="grid grid-cols-2 gap-0 relative -mt-[16px]">
                    <!-- Left Column with U-Ribbon -->
                    <div class="journey-ribbon-left p-4 sm:p-5 pr-2">
                        <div class="rounded-[28px] overflow-hidden shadow-md h-[300px] lg:h-[320px]">
                            <img
                                src="{{ asset('images/founder-meeting.jpg') }}"
                                alt="{{ $isEn ? 'Personal dialogue and partnership' : 'Personlig dialog og partnerskab' }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                width="640"
                                height="420"
                            >
                        </div>
                    </div>

                    <!-- Right Column with Milestone Text -->
                    <div class="relative flex flex-col justify-center px-8 lg:px-12 py-6">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309] shadow-2xs mb-4">
                            <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 text-[#B45309]" />
                        </div>
                        <h3 class="text-2xl font-black text-navy mb-3 tracking-tight">
                            {{ $isEn ? 'Bridging the Gap Between Businesses and Staff' : 'Brobygning mellem virksomheder og vikarer' }}
                        </h3>
                        <p class="text-sm text-ink/80 leading-relaxed max-w-md">
                            {{ $isEn
                                ? 'One of the biggest challenges I noticed was the gap between companies and temporary workers. Businesses feel workers do not fully grasp expectations, while workers arrive without enough information about standards. I strongly believe that a personal touch, genuine care, and clear communication bridge this gap. For me, providing staff is about building relationships, preparing employees, and ensuring both sides feel supported.'
                                : 'En af de største udfordringer i vikarbranchen var kløften mellem virksomheder og vikarer. Virksomheder oplever ofte, at vikarerne mangler indsigt i forventningerne, mens vikarerne ankommer uden nok information. Jeg er overbevist om, at personlig kontakt, oprigtig omtanke og klar kommunikation bygger bro over denne kløft og skaber tryghed for alle.' }}
                        </p>

                        <!-- Connector along bottom to meet Row 4 -->
                        <div class="journey-connector-bottom"></div>
                    </div>
                </div>

                <!-- ROW 4: Text Left, Image Right (Ribbon curves Right) -->
                <div class="grid grid-cols-2 gap-0 relative -mt-[16px]">
                    <!-- Left Column with Milestone Text -->
                    <div class="relative flex flex-col justify-center px-8 lg:px-12 py-6">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309] shadow-2xs mb-4">
                            <x-heroicon-o-check-badge class="w-5 h-5 text-[#B45309]" />
                        </div>
                        <h3 class="text-2xl font-black text-navy mb-3 tracking-tight">
                            {{ $isEn ? 'The Right Person in the Right Place' : 'Det rette menneske på det rette sted' }}
                        </h3>
                        <p class="text-sm text-ink/80 leading-relaxed max-w-md">
                            {{ $isEn
                                ? 'The right person in the right place, at the right time. Every employee has different strengths, experiences, and working styles. The key is recognizing those strengths and matching them with the right working environment. A good staffing company should know its employees just as well as it knows its clients. By understanding both sides, we create better working relationships, improve productivity, and deliver high quality.'
                                : 'Det rette menneske på det rette sted – til det rette tidspunkt. Alle medarbejdere har unikke styrker, erfaringer og arbejdsstile. Nøglen er at anerkende disse styrker og matche dem med det rette arbejdsmiljø. Et godt vikarbureau bør kende sine medarbejdere lige så godt, som det kender sine kunder for at skabe bedre resultater og højere produktivitet.' }}
                        </p>

                        <!-- Connector along bottom to meet Row 5 -->
                        <div class="journey-connector-bottom"></div>
                    </div>

                    <!-- Right Column with U-Ribbon -->
                    <div class="journey-ribbon-right p-4 sm:p-5 pl-2">
                        <div class="rounded-[28px] overflow-hidden shadow-md h-[300px] lg:h-[320px]">
                            <img
                                src="{{ asset('images/chef-pastry-piping.jpg') }}"
                                alt="{{ $isEn ? 'Professional craft precision' : 'Faglig præcision i arbejdet' }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                width="640"
                                height="420"
                            >
                        </div>
                    </div>
                </div>

                <!-- ROW 5: Image Left, Text Right (Ribbon curves Left and ends smoothly) -->
                <div class="grid grid-cols-2 gap-0 relative -mt-[16px]">
                    <!-- Left Column with U-Ribbon -->
                    <div class="journey-ribbon-left p-4 sm:p-5 pr-2">
                        <div class="rounded-[28px] overflow-hidden shadow-md h-[300px] lg:h-[320px]">
                            <img
                                src="{{ asset('images/banquet-plating-rack.jpg') }}"
                                alt="{{ $isEn ? 'Dedicated teamwork in hospitality' : 'Dedikeret teamarbejde i branchen' }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                width="640"
                                height="420"
                            >
                        </div>
                    </div>

                    <!-- Right Column with Milestone Text -->
                    <div class="relative flex flex-col justify-center px-8 lg:px-12 py-6">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309] shadow-2xs mb-4">
                            <x-heroicon-o-arrow-trending-up class="w-5 h-5 text-[#B45309]" />
                        </div>
                        <h3 class="text-2xl font-black text-navy mb-3 tracking-tight">
                            {{ $isEn ? 'Looking Ahead' : 'Fremtidsvision: Mere end et vikarbureau' }}
                        </h3>
                        <p class="text-sm text-ink/80 leading-relaxed max-w-md">
                            {{ $isEn
                                ? 'I believe the future of staffing is about creating partnerships based on trust, reliability, communication, and mutual understanding. Businesses should feel confident that people arriving understand expectations. Employees should feel prepared, respected, and supported. At Freya Service, we don’t just fill vacancies. We understand the people, the workplace, and the expectations behind every shift.'
                                : 'Fremtidens bemanding handler om at skabe partnerskaber bygget på tillid, pålidelighed, kommunikation og gensidig forståelse. Virksomheder skal være trygge ved, at folkene på gulvet forstår opgaven. Medarbejderne skal føle sig forberedte og respekterede. For hos Freya Service udfylder vi ikke bare ledige vagter. Vi forstår menneskene og arbejdspladsen bag hver enkelt vagt.' }}
                        </p>

                        <!-- Final bottom cap (ends smoothly with rounded cap as in screenshot) -->
                        <div class="absolute bottom-0 left-0 right-4 h-[16px] bg-[#1E4742] rounded-r-full pointer-events-none"></div>
                    </div>
                </div>

            </div>

            <!-- MOBILE RESPONSIVE TIMELINE (< md screens) -->
            <div class="md:hidden space-y-10 relative pl-6 border-l-[6px] border-[#1E4742] ml-2">

                <!-- Mobile Milestone 1 -->
                <div class="relative space-y-4">
                    <span class="absolute -left-[37px] top-1 w-6 h-6 rounded-full bg-[#1E4742] border-4 border-white shadow-xs"></span>
                    <div class="w-10 h-10 rounded-xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309]">
                        <x-heroicon-o-fire class="w-5 h-5 text-[#B45309]" />
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md h-[220px]">
                        <img src="{{ asset('images/chef-grill-steaks.jpg') }}" alt="{{ $isEn ? 'Chef at work in kitchen' : 'Kok i arbejde i køkkenet' }}" class="w-full h-full object-cover" width="600" height="220" loading="lazy" decoding="async">
                    </div>
                    <h3 class="text-xl font-black text-navy">{{ $isEn ? 'From Humble Beginnings' : 'Fra køkkengulvet: 16 års erfaring' }}</h3>
                    <p class="text-sm text-ink/80 leading-relaxed">
                        {{ $isEn
                            ? 'After 16 years of working as a chef in the hospitality industry, I realized something important: successful service is not just about having enough people. It is about having the right people in the right place.'
                            : 'Efter 16 år som kok i restaurationsbranchen indså jeg noget afgørende: succesfuld service handler ikke kun om at have folk nok. Det handler om at have de rette mennesker på det rette sted.' }}
                    </p>
                </div>

                <!-- Mobile Milestone 2 -->
                <div class="relative space-y-4">
                    <span class="absolute -left-[37px] top-1 w-6 h-6 rounded-full bg-[#1E4742] border-4 border-white shadow-xs"></span>
                    <div class="w-10 h-10 rounded-xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309]">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-[#B45309]" />
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md h-[220px]">
                        <img src="{{ asset('images/founder-portrait.jpg') }}" alt="{{ $isEn ? 'Founder of Freya Service' : 'Stifter af Freya Service' }}" class="w-full h-full object-cover object-top" width="600" height="220" loading="lazy" decoding="async">
                    </div>
                    <h3 class="text-xl font-black text-navy">{{ $isEn ? 'Understanding the Industry from the Inside' : 'Forståelse af branchen indefra' }}</h3>
                    <p class="text-sm text-ink/80 leading-relaxed">
                        {{ $isEn
                            ? 'Every workplace is different. A busy hotel kitchen does not have the same requirements as a small restaurant. The real solution is understanding the workplace, its culture, and finding the person who truly fits.'
                            : 'Ingen arbejdspladser er ens. Et travlt hotelkøkken stiller ikke de samme krav som en lille restaurant. Den virkelige løsning er at forstå arbejdspladsen og finde den person, der reelt passer ind.' }}
                    </p>
                </div>

                <!-- Mobile Milestone 3 -->
                <div class="relative space-y-4">
                    <span class="absolute -left-[37px] top-1 w-6 h-6 rounded-full bg-[#1E4742] border-4 border-white shadow-xs"></span>
                    <div class="w-10 h-10 rounded-xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309]">
                        <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 text-[#B45309]" />
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md h-[220px]">
                        <img src="{{ asset('images/founder-meeting.jpg') }}" alt="{{ $isEn ? 'Dialogue and partnership' : 'Personlig dialog og partnerskab' }}" class="w-full h-full object-cover" width="600" height="220" loading="lazy" decoding="async">
                    </div>
                    <h3 class="text-xl font-black text-navy">{{ $isEn ? 'Bridging the Gap Between Businesses and Staff' : 'Brobygning mellem virksomheder og vikarer' }}</h3>
                    <p class="text-sm text-ink/80 leading-relaxed">
                        {{ $isEn
                            ? 'I strongly believe that a personal touch, genuine care, and clear communication can bridge the gap between businesses and temporary staff, creating reliable relationships.'
                            : 'Jeg er overbevist om, at personlig kontakt, oprigtig omtanke og klar kommunikation bygger bro over kløften mellem virksomheder og vikarer.' }}
                    </p>
                </div>

                <!-- Mobile Milestone 4 -->
                <div class="relative space-y-4">
                    <span class="absolute -left-[37px] top-1 w-6 h-6 rounded-full bg-[#1E4742] border-4 border-white shadow-xs"></span>
                    <div class="w-10 h-10 rounded-xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309]">
                        <x-heroicon-o-check-badge class="w-5 h-5 text-[#B45309]" />
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md h-[220px]">
                        <img src="{{ asset('images/chef-pastry-piping.jpg') }}" alt="{{ $isEn ? 'Culinary craft precision' : 'Håndværksmæssig præcision' }}" class="w-full h-full object-cover" width="600" height="220" loading="lazy" decoding="async">
                    </div>
                    <h3 class="text-xl font-black text-navy">{{ $isEn ? 'The Right Person in the Right Place' : 'Det rette menneske på det rette sted' }}</h3>
                    <p class="text-sm text-ink/80 leading-relaxed">
                        {{ $isEn
                            ? 'The right person in the right place, at the right time. By understanding both our clients and employees, we deliver the quality businesses expect.'
                            : 'Den rette person på det rette sted – til det rette tidspunkt. Ved at kende vores medarbejdere lige så godt som vores kunder sikrer vi høj kvalitet.' }}
                    </p>
                </div>

                <!-- Mobile Milestone 5 -->
                <div class="relative space-y-4">
                    <span class="absolute -left-[37px] top-1 w-6 h-6 rounded-full bg-[#1E4742] border-4 border-white shadow-xs"></span>
                    <div class="w-10 h-10 rounded-xl bg-[#FFF8EB] border border-[#FDE68A] flex items-center justify-center text-[#B45309]">
                        <x-heroicon-o-arrow-trending-up class="w-5 h-5 text-[#B45309]" />
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md h-[220px]">
                        <img src="{{ asset('images/banquet-plating-rack.jpg') }}" alt="{{ $isEn ? 'Looking ahead banquet service' : 'Fremtidsvision og bankselskab' }}" class="w-full h-full object-cover" width="600" height="220" loading="lazy" decoding="async">
                    </div>
                    <h3 class="text-xl font-black text-navy">{{ $isEn ? 'Looking Ahead' : 'Fremtidsvision: Mere end et vikarbureau' }}</h3>
                    <p class="text-sm text-ink/80 leading-relaxed">
                        {{ $isEn
                            ? 'At Freya Service, we don’t just fill vacancies. We understand the people, the workplace, and the expectations behind every shift.'
                            : 'Hos Freya Service udfylder vi ikke bare ledige vagter. Vi forstår menneskene, arbejdspladsen og forventningerne bag hver enkelt shift.' }}
                    </p>
                </div>

            </div>

            <!-- Founder Sign-off Statement Box -->
            <section class="mt-20 sm:mt-28 bg-sand rounded-3xl p-8 sm:p-12 border-2 border-mist shadow-sm text-center max-w-4xl mx-auto">
                <div class="w-14 h-14 rounded-full bg-[#1E4742]/10 mx-auto flex items-center justify-center mb-5">
                    <x-heroicon-o-sparkles class="w-7 h-7 text-[#1E4742]" />
                </div>
                <blockquote class="text-base sm:text-lg font-bold text-navy leading-relaxed mb-6 italic max-w-2xl mx-auto">
                    {{ $isEn
                        ? '“I started my journey as a chef, learning the industry from the kitchen floor. Today, through Freya Service, my goal is to use that experience to make a meaningful difference in how businesses and temporary workers work together. Because at Freya Service, we don’t just fill vacancies. We understand the people, the workplace, and the expectations behind every shift.”'
                        : '”Jeg startede min rejse som kok og lærte branchen fra køkkengulvet. I dag, gennem Freya Service, er mit mål at bruge denne erfaring til at gøre en mærkbar forskel i måden, virksomheder og vikarer arbejder sammen på. For hos Freya Service udfylder vi ikke bare ledige vagter. Vi forstår menneskene, arbejdspladsen og forventningerne bag hver enkelt vagt.”' }}
                </blockquote>
                <div class="inline-block border-t border-mist pt-4">
                    <div class="font-black text-navy text-base sm:text-lg">{{ $isEn ? '— Founder, Freya Service ApS' : '— Stifter, Freya Service ApS' }}</div>
                    <div class="text-xs text-ink/70 font-semibold">{{ $isEn ? '16+ Years Chef Experience • Hospitality Operations' : '16+ års kokerfaring • Erfaring fra hotel- og restaurantdrift' }}</div>
                </div>
            </section>

            <!-- Call to Action Section -->
            <section class="mt-14 sm:mt-20 bg-navy text-white rounded-3xl p-8 sm:p-14 border border-navy-800 shadow-2xl text-center relative overflow-hidden" style="background-image:radial-gradient(rgba(246,241,233,0.08) 1.5px,transparent 0);background-size:24px 24px;">
                <div class="max-w-2xl mx-auto relative z-10 space-y-6">
                    <h2 class="text-2xl sm:text-4xl font-black text-white">
                        {{ $isEn ? 'Ready to Experience the Difference?' : 'Klar til at opleve forskellen?' }}
                    </h2>
                    <p class="text-sand-200 text-sm sm:text-base leading-relaxed">
                        {{ $isEn
                            ? 'Whether you need an urgent kitchen replacement tonight or reliable long-term staff, our team is ready 24/7.'
                            : 'Hvad enten du mangler en akut afløser i køkkenet i aften eller faste vikarer til de kommende måneder, er vi klar 24/7.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                        <a href="{{ route('login') }}" class="btn-primary w-full sm:w-auto border-2 border-white/35 inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl text-sm font-bold text-white shadow-lg transition">
                            <x-heroicon-o-plus-circle class="w-5 h-5" />
                            <span>{{ $isEn ? 'Request Staff Online' : 'Bestil vikar online' }}</span>
                        </a>
                        <a href="tel:+4528260926" class="btn-secondary w-full sm:w-auto border-2 border-teal bg-transparent text-white hover:bg-teal/10 inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl text-sm font-bold transition">
                            <x-heroicon-o-phone class="w-5 h-5 text-teal" />
                            <span>{{ $isEn ? 'Call +45 28 26 09 26' : 'Ring +45 28 26 09 26' }}</span>
                        </a>
                        <a href="{{ route('contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-semibold text-sand-300 hover:text-white transition">
                            <span>{{ $isEn ? 'Contact Us' : 'Kontakt os' }}</span>
                            <x-heroicon-o-arrow-right class="w-4 h-4" />
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </main>
</x-public-layout>
