# Arratiako Musika Eskola — Copilot Instructions

## Project Overview
WordPress custom theme (`arratia-musika`) for Arratiako Musika Eskola, a music school in the Arratia valley (Bizkaia, Basque Country). Primary language: Euskera. PHP prefix: `arratia_`. DB table for enrollments: `wp_arratia_matriculas`.

## Site-wide Config
All contact data, social URLs, and site settings live in `wp-content/themes/arratia-musika/inc/site-config.php` as PHP constants (`ARRATIA_TELEFONO`, `ARRATIA_EMAIL`, `ARRATIA_INSTAGRAM_URL`, etc.). Never hardcode these values in templates.

## Design Context

### Users
Two profiles, almost always on **mobile**:
1. **Parents** (30–50) enrolling their children — fast browsing, emotional decision, want to know what's offered and how to enroll.
2. **Adults** (25–60) wanting to learn or return to an instrument — more reflective, need to feel the school is serious but accessible.

Primary job of the site: **facilitate enrollment**. Secondary: show activities and who they are.

### Brand Personality
**Local · Joyful · Creative · Serious**

Tone: warmth of a neighborhood school + professional confidence. Not a corporate chain, not a rigid conservatory.

### Aesthetic Direction
- **Theme**: Light. Warm. Cream-clay-forest palette.
- **Direction**: Organic editorial. Between a regional cultural magazine and a well-made artisan poster.
- **Anti-reference**: Generic music academy chains, SaaS/tech look, institutional blues.
- **Mobile-first strict**: Design and validate at 390px first. Desktop is an expansion.

### Color Palette
```css
--bg / --beige:    #F8F5F0  /* Crema Nube — global background */
--black:           #4A3728  /* Café Profundo — headings */
--body:            #333333  /* Gris Carbón — body text */
--accent:          #BC4749  /* Rojo Arcilla — primary CTA only */
--accent-dk:       #9B3436
--secondary:       #E0D5C1  /* Arena Suave — secondary buttons */
--green:           #2D463E  /* Verde Bosque — footer, contrast elements */
```

### Design Principles
1. **Enrollment first** — CTA must be visible without scrolling on mobile.
2. **Warmth without losing seriousness** — works for a demanding parent AND a serious adult learner.
3. **Local and identifiable** — Arratia valley, Euskera, community present visually.
4. **Accent is scarce** — `--accent` red for primary actions only. Don't scatter it.
5. **Mobile is the product** — every component validated at 390px first.
