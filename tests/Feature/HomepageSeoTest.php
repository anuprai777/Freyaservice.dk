<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageSeoTest extends TestCase
{
    public function test_homepage_danish_seo_head_tags_and_metadata(): void
    {
        $response = $this->withSession(['locale' => 'da'])->get('/');

        $response->assertStatus(200);

        // DA Title check: under 60 chars, includes "Vikarbureau Danmark"
        $title = 'Vikarbureau Danmark: Vikarer under 2 timer | Freya Service';
        $this->assertLessThanOrEqual(60, mb_strlen($title));
        $this->assertStringContainsString('Vikarbureau Danmark', $title);
        $response->assertSee("<title>{$title}</title>", false);

        // DA Meta Description check: 155-160 chars, covers sectors, 2-hour response, no lock-in/onboarding, CTA
        $metaDescription = 'Vikarbureau med vikarer til hotel, restaurant, lager og kontor i hele Danmark på under 2 timer. Ingen binding eller oprettelsesgebyr. Bestil vikar online nu!';
        $this->assertGreaterThanOrEqual(155, mb_strlen($metaDescription));
        $this->assertLessThanOrEqual(160, mb_strlen($metaDescription));
        $response->assertSee('<meta name="description" content="' . $metaDescription . '">', false);

        // Canonical & hreflang
        $response->assertSee('<link rel="canonical" href="https://freyaservice.dk">', false);
        $response->assertSee('<link rel="alternate" hreflang="da" href="https://freyaservice.dk">', false);
        $response->assertSee('<link rel="alternate" hreflang="en" href="https://freyaservice.dk/locale/en">', false);
        $response->assertSee('<link rel="alternate" hreflang="x-default" href="https://freyaservice.dk">', false);

        // Open Graph & Twitter
        $response->assertSee('<meta property="og:site_name" content="Freya Service">', false);
        $response->assertSee('<meta property="og:url" content="https://freyaservice.dk">', false);
        $response->assertSee('<meta property="og:locale" content="da_DK">', false);
        $response->assertSee('<meta name="twitter:card" content="summary_large_image">', false);
    }

    public function test_homepage_english_seo_head_tags_and_metadata(): void
    {
        $response = $this->withSession(['locale' => 'en'])->get('/');

        $response->assertStatus(200);

        // EN Title check: under 60 chars, includes "Temp Staffing Denmark" and "vikarbureau"
        $title = 'Temp Staffing Denmark: Danish Vikarbureau | Freya Service';
        $this->assertLessThanOrEqual(60, mb_strlen($title));
        $this->assertStringContainsString('Temp Staffing Denmark', $title);
        $this->assertStringContainsString('Vikarbureau', $title);
        $response->assertSee("<title>{$title}</title>", false);

        // EN Meta Description check: 155-160 chars
        $metaDescription = 'Temp staffing across Denmark for hotels, restaurants, warehouses and offices in under 2 hours. No lock-in or onboarding fees. Request vetted staff online now!';
        $this->assertGreaterThanOrEqual(155, mb_strlen($metaDescription));
        $this->assertLessThanOrEqual(160, mb_strlen($metaDescription));
        $response->assertSee('<meta name="description" content="' . $metaDescription . '">', false);

        // Open Graph
        $response->assertSee('<meta property="og:locale" content="en_US">', false);
    }

    public function test_single_h1_and_intro_copy_requirements(): void
    {
        // Danish view
        $responseDa = $this->withSession(['locale' => 'da'])->get('/');
        $responseDa->assertStatus(200);

        // Only one H1 tag
        $contentDa = $responseDa->getContent();
        $this->assertEquals(1, substr_count($contentDa, '<h1'));
        $this->assertStringContainsString('bureau i Danmark: godkendte', $contentDa);
        $this->assertStringContainsString('klar på under 2 timer', $contentDa);

        // Intro copy includes main keyword, vikarbureau, 16+ years experience, and core offer
        $responseDa->assertSee('Med 16+ års erfaring er Freya Service et vikarbureau i Danmark, der leverer landsdækkende vikarservice til hotel, restaurant, lager og kontor på under 2 timer – uden binding eller oprettelsesgebyr.');

        // English view
        $responseEn = $this->withSession(['locale' => 'en'])->get('/');
        $responseEn->assertStatus(200);

        $contentEn = $responseEn->getContent();
        $this->assertEquals(1, substr_count($contentEn, '<h1'));
        $this->assertStringContainsString('staffing in Denmark: vetted', $contentEn);
        $this->assertStringContainsString('ready in under 2 hours', $contentEn);

        // Intro copy EN
        $responseEn->assertSee('With 16+ years of experience, Freya Service is a Danish vikarbureau providing nationwide temp staffing for hotels, restaurants, warehouses and offices in under 2 hours, with no lock-in or onboarding fees.');
    }

    public function test_descriptive_navigation_links(): void
    {
        $responseDa = $this->withSession(['locale' => 'da'])->get('/');
        $responseDa->assertSee('Ydelser');
        $responseDa->assertSee('Brancher');
        $responseDa->assertSee('Om os');
        $responseDa->assertSee('Sådan virker det');
        $responseDa->assertSee('Kontakt');

        $responseEn = $this->withSession(['locale' => 'en'])->get('/');
        $responseEn->assertSee('Services');
        $responseEn->assertSee('Industries');
        $responseEn->assertSee('About Us');
        $responseEn->assertSee('How It Works');
        $responseEn->assertSee('Contact');
    }

    public function test_about_page_renders_in_english_and_danish(): void
    {
        // Danish view
        $responseDa = $this->withSession(['locale' => 'da'])->get('/about');
        $responseDa->assertStatus(200);
        $responseDa->assertSee('Om os - Historien bag Freya Service ApS');
        $responseDa->assertSee('Bygget på erfaring, drevet af forståelse og inspireret af mennesker');
        $responseDa->assertSee('founder-portrait.jpg');
        $responseDa->assertSee('founder-meeting.jpg');
        $responseDa->assertSee('16+ års kokerfaring');
        $responseDa->assertSee('Stifter, Freya Service ApS');

        // English view
        $responseEn = $this->withSession(['locale' => 'en'])->get('/about');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('About Us - The Story Behind Freya Service ApS');
        $responseEn->assertSee('Built on Experience, Driven by Understanding, and Inspired by People');
        $responseEn->assertSee('founder-portrait.jpg');
        $responseEn->assertSee('founder-meeting.jpg');
        $responseEn->assertSee('16+ Years Chef Experience');
        $responseEn->assertSee('Founder, Freya Service ApS');
    }

    public function test_industries_ordered_list_and_faq_sections_exist(): void
    {
        $response = $this->get('/');

        // Industries section with individual anchor links and descriptions
        $response->assertSee('id="industries"', false);
        $response->assertSee('/industries#hotel');
        $response->assertSee('/industries#restaurant');
        $response->assertSee('/industries#warehouse');
        $response->assertSee('/industries#office');

        // How it works 3-step ordered list
        $response->assertSee('id="how-it-works"', false);
        $response->assertSee('<ol class="grid md:grid-cols-3 gap-8 list-none">', false);
        $response->assertSee('1. Angiv dit bemandingsbehov');
        $response->assertSee('2. Godkendte vikarer rykker ud på under 2 timer');
        $response->assertSee('3. Digital QR-tjek ind og gennemskuelig faktura');

        // FAQ section with 6 questions
        $response->assertSee('id="faq"', false);
        $response->assertSee('Hvor hurtigt kan jeg få en vikar i Danmark?');
        $response->assertSee('Er der bindingsperiode eller oprettelsesgebyrer?');
        $response->assertSee('Følger vikarerne danske overenskomster?');
        $response->assertSee('Hvad koster en vikar gennem Freya Service?');
        $response->assertSee('Hvilke brancher leverer Freya Service vikarer til?');
        $response->assertSee('Hvordan kvalitetssikres og godkendes vikarerne?');

        // Structured data JSON-LD EmploymentAgency + FAQPage
        $response->assertSee('"@type": "EmploymentAgency"', false);
        $response->assertSee('"@type": "FAQPage"', false);
        $response->assertSee('"telephone": "+4528260926"', false);
        $response->assertSee('"vatID": "DK44556677"', false);
        $response->assertSee('https://freyaservice.dk/#organization', false);
        $response->assertSee('https://freyaservice.dk/#faq', false);
    }

    public function test_key_claims_and_contact_info_are_preserved(): void
    {
        $response = $this->get('/');

        // 16+ years experience
        $response->assertSee('16+');
        $response->assertSee('ÅRS ERFARING');

        // 98% satisfaction
        $response->assertSee('98%');

        // 2,500+ temps
        $response->assertSee('2.500+');

        // Under 2 hours response
        $response->assertSee('&lt; 2t', false);

        // Compliance & fees
        $response->assertSee('100%');
        $response->assertSee('Ingen binding');

        // Contact & CVR
        $response->assertSee('+45 28 26 09 26');
        $response->assertSee('44556677');
    }

    public function test_robots_and_sitemap_files_exist_and_are_valid(): void
    {
        $robotsPath = public_path('robots.txt');
        $this->assertFileExists($robotsPath);
        $robotsContent = file_get_contents($robotsPath);
        $this->assertStringContainsString('Sitemap: https://freyaservice.dk/sitemap.xml', $robotsContent);

        $sitemapPath = public_path('sitemap.xml');
        $this->assertFileExists($sitemapPath);
        $sitemapContent = file_get_contents($sitemapPath);
        $this->assertStringContainsString('https://freyaservice.dk/', $sitemapContent);
        $this->assertStringContainsString('hreflang="da"', $sitemapContent);
        $this->assertStringContainsString('hreflang="en"', $sitemapContent);
    }
}
