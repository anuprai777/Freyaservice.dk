import React from 'react';
import { createRoot } from 'react-dom/client';
import { LetterCascade } from './components/ui/letter-cascade';

export function initLetterCascade() {
    const elements = document.querySelectorAll('[data-letter-cascade]');
    elements.forEach((el) => {
        if (el.dataset.cascadeMounted) return;
        el.dataset.cascadeMounted = 'true';

        const text = el.getAttribute('data-letter-cascade') || el.textContent?.trim() || '';
        const className = el.getAttribute('data-cascade-class') || '';
        const letterClassName = el.getAttribute('data-letter-class') || '';
        const triggerOnClick = el.hasAttribute('data-trigger-click');
        const staggerFrom = el.getAttribute('data-stagger-from') || 'first';
        const staggerDuration = parseFloat(el.getAttribute('data-stagger-duration') || '0.04');

        el.textContent = '';
        const root = createRoot(el);
        root.render(
            <LetterCascade
                text={text}
                className={className}
                letterClassName={letterClassName}
                triggerOnClick={triggerOnClick}
                staggerFrom={staggerFrom}
                staggerDuration={staggerDuration}
            />
        );
    });
}

if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLetterCascade);
    } else {
        initLetterCascade();
    }
}
