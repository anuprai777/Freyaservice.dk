<x-public-layout>
    @php
        $isEn = app()->getLocale() === 'en';

        $milestones = [
            [
                'image' => 'chef-grill-steaks.jpg',
                'alt' => $isEn ? 'Chef at work in a professional kitchen' : 'Kok i arbejde i et professionelt køkken',
                'title' => $isEn ? 'From the kitchen floor' : 'Fra køkkengulvet',
                'body' => $isEn
                    ? 'After 16 years as a chef in the hospitality industry, I realised something important: successful service is not only about having enough people. It is about having the right people in the right place. Working in different kitchens, hotels and restaurants taught me the pressure businesses face every single day.'
                    : 'Efter 16 år som kok i restaurationsbranchen indså jeg noget afgørende: succesfuld service handler ikke kun om at have folk nok. Det handler om at have de rette mennesker på det rette sted. Gennem min karriere i forskellige køkkener, hoteller og restauranter oplevede jeg på nærmeste hold presset ved at drive en travl forretning.',
            ],
            [
                'image' => 'founder-portrait.jpg',
                'alt' => $isEn ? 'Founder of Freya Service ApS' : 'Stifter af Freya Service ApS',
                'title' => $isEn ? 'Understanding the industry from the inside' : 'Forståelse af branchen indefra',
                'body' => $isEn
                    ? 'Having spent 16 years on the operational side, I know that no two workplaces are alike. A busy hotel kitchen does not have the same requirements as a small restaurant, and a corporate canteen runs differently from an à la carte restaurant. Sending an available worker to fill an empty shift was never the solution. Understanding the workplace and finding the person who truly fits is.'
                    : 'Efter 16 år på den operationelle side ved jeg, at ingen arbejdspladser er ens. Et travlt hotelkøkken stiller ikke de samme krav som en lille restaurant, og en kantine fungerer anderledes end en à la carte-restaurant. At sende en tilfældig person ud til en vagt var aldrig løsningen. Det er til gengæld at forstå arbejdspladsen og finde det menneske, der reelt passer ind.',
            ],
            [
                'image' => 'founder-meeting.jpg',
                'alt' => $isEn ? 'Personal dialogue and partnership' : 'Personlig dialog og partnerskab',
                'title' => $isEn ? 'Bridging the gap between businesses and staff' : 'Bro mellem virksomheder og vikarer',
                'body' => $isEn
                    ? 'One of the biggest challenges in staffing is the gap between companies and temporary workers. Businesses feel workers do not fully grasp expectations, while workers arrive without enough information about standards. Personal contact, genuine care and clear communication bridge that gap and create security for everyone involved.'
                    : 'En af de største udfordringer i vikarbranchen er kløften mellem virksomheder og vikarer. Virksomheder oplever ofte, at vikarerne mangler indsigt i forventningerne, mens vikarerne ankommer uden nok information. Personlig kontakt, oprigtig omtanke og klar kommunikation bygger bro over den kløft og skaber tryghed for alle parter.',
            ],
            [
                'image' => 'chef-pastry-piping.jpg',
                'alt' => $isEn ? 'Craft and precision in the kitchen' : 'Faglig præcision i køkkenet',
                'title' => $isEn ? 'The right person in the right place' : 'Det rette menneske på det rette sted',
                'body' => $isEn
                    ? 'The right person, in the right place, at the right time. Every employee has different strengths, experience and working style. The key is to recognise those strengths and match them with the right environment. A good staffing company knows its people as well as it knows its clients — that is what creates better relationships, higher productivity and lasting quality.'
                    : 'Det rette menneske på det rette sted – til det rette tidspunkt. Alle medarbejdere har unikke styrker, erfaringer og arbejdsstile. Nøglen er at anerkende disse styrker og matche dem med det rette arbejdsmiljø. Et godt vikarbureau kender sine medarbejdere lige så godt, som det kender sine kunder – og det er netop det, der skaber bedre relationer, højere produktivitet og varig kvalitet.',
            ],
            [
                'image' => 'banquet-plating-rack.jpg',
                'alt' => $isEn ? 'Teamwork during service' : 'Teamarbejde under service',
                'title' => $isEn ? 'Looking ahead' : 'Fremtidsvision',
                'body' => $isEn
                    ? 'I believe the future of staffing is built on partnerships grounded in trust, reliability, communication and mutual understanding. Businesses should feel confident that the people arriving understand the task. Employees should feel prepared, respected and supported. At Freya Service we do not just fill vacancies — we understand the people, the workplace and the expectations behind every shift.'
                    : 'Jeg tror på, at fremtidens bemanding bygger på partnerskaber med tillid, pålidelighed, kommunikation og gensidig forståelse. Virksomheder skal være trygge ved, at folkene på gulvet forstår opgaven. Medarbejderne skal føle sig forberedte og respekterede. Hos Freya Service udfylder vi ikke bare ledige vagter – vi forstår menneskene, arbejdspladsen og forventningerne bag hver enkelt vagt.',
            ],
        ];
    @endphp

    <x-slot name="title">{{ $isEn ? 'About Us - The Story Behind Freya Service ApS' : 'Om os - Historien bag Freya Service ApS' }}</x-slot>
    <x-slot name="metaDescription">{{ $isEn ? 'The story behind Freya Service ApS: built on 16 years of hands-on chef experience, driven by understanding, and inspired by people.' : 'Historien bag Freya Service ApS: bygget på 16 års praktisk erfaring som kok i restaurationsbranchen. Vi sætter det rette menneske på det rette sted.' }}</x-slot>

    <!-- Hero Header (Cream Background #FAF5F2) -->
    <section class="bg-[#FAF5F2] text-ink py-16 sm:py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden border-b border-[#EADBCC]" style="background-image:radial-gradient(rgba(90,20,41,0.035) 1.5px,transparent 0);background-size:24px 24px;">
        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-[#5A1429] mb-5 leading-[1.1] text-balance">
                    {{ $isEn ? 'Built on Experience, Driven by Understanding, and Inspired by People' : 'Bygget på erfaring, drevet af forståelse og inspireret af mennesker' }}
                </h1>
                <p class="text-base sm:text-lg text-ink/75 leading-relaxed max-w-2xl mx-auto">
                    {{ $isEn
                        ? 'Freya Service is a Danish staffing partner for hospitality and service businesses — built on 16 years in professional kitchens and one simple belief: the right person in the right place changes everything.'
                        : 'Freya Service er en dansk bemandingspartner for hotel-, restaurant- og servicevirksomheder — bygget på 16 år i professionelle køkkener og en enkel overbevisning: det rette menneske på det rette sted gør hele forskellen.' }}
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

    <main class="bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">

            <!-- Section header: heading left, introduction right -->
            <div class="grid lg:grid-cols-12 gap-6 lg:gap-12 lg:items-end mb-14 sm:mb-20">
                <div class="lg:col-span-7">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#5A1429] tracking-tight leading-tight">
                        {{ $isEn ? 'The story behind Freya Service' : 'Historien bag Freya Service' }}
                    </h2>
                </div>
                <div class="lg:col-span-5">
                    <p class="text-sm sm:text-base text-ink/75 leading-relaxed">
                        {{ $isEn
                            ? 'From a career in professional kitchens to a nationwide staffing partner — the values behind how we match people and workplaces.'
                            : 'Fra en karriere i professionelle køkkener til en landsdækkende bemandingspartner — værdierne bag den måde, vi matcher mennesker og arbejdspladser på.' }}
                    </p>
                </div>
            </div>

            <!-- Journey: alternating editorial rows -->
            <div class="space-y-16 sm:space-y-24">
                @foreach ($milestones as $index => $milestone)
                    <article class="grid md:grid-cols-2 gap-8 lg:gap-16 items-center">
                        <div class="{{ $index % 2 === 1 ? 'md:order-2' : '' }}">
                            <img
                                src="{{ asset('images/' . $milestone['image']) }}"
                                alt="{{ $milestone['alt'] }}"
                                class="w-full aspect-[4/3] object-cover rounded-2xl bg-[#F3E3E6]"
                                width="640"
                                height="480"
                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                decoding="async"
                            >
                        </div>
                        <div class="{{ $index % 2 === 1 ? 'md:order-1' : '' }}">
                            <h3 class="text-2xl sm:text-3xl font-black text-[#5A1429] tracking-tight leading-snug mb-4 text-balance">
                                {{ $milestone['title'] }}
                            </h3>
                            <p class="text-sm sm:text-base text-ink/80 leading-relaxed">
                                {{ $milestone['body'] }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Founder statement -->
        <section class="bg-[#FAF5F2] border-t border-[#EADBCC] py-16 sm:py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <blockquote class="text-xl sm:text-2xl font-bold text-[#5A1429] leading-relaxed text-balance">
                    {{ $isEn
                        ? '“I started my journey as a chef, learning the industry from the kitchen floor. Today, through Freya Service, my goal is to use that experience to make a meaningful difference in how businesses and temporary workers work together.”'
                        : '”Jeg startede min rejse som kok og lærte branchen fra køkkengulvet. I dag, gennem Freya Service, er mit mål at bruge denne erfaring til at gøre en mærkbar forskel i måden, virksomheder og vikarer arbejder sammen på.”' }}
                </blockquote>
                <div class="mt-8 flex items-center justify-center gap-3">
                    <img
                        src="{{ asset('images/founder-portrait.jpg') }}"
                        alt="{{ $isEn ? 'Founder of Freya Service ApS' : 'Stifter af Freya Service ApS' }}"
                        class="w-12 h-12 rounded-full object-cover object-top bg-[#F3E3E6]"
                        width="48"
                        height="48"
                        loading="lazy"
                        decoding="async"
                    >
                    <div class="text-left">
                        <div class="font-black text-[#5A1429] text-sm sm:text-base">{{ $isEn ? 'Founder, Freya Service ApS' : 'Stifter, Freya Service ApS' }}</div>
                        <div class="text-xs text-ink/60 font-semibold">{{ $isEn ? '16+ Years Chef Experience • Hospitality operations' : '16+ års kokerfaring • Hotel- og restaurantdrift' }}</div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-public-layout>
