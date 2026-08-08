# María José Oficial — WordPress theme

A modern classic theme with no frontend runtime dependencies. It uses component-based PHP,
Sass, and vanilla JavaScript.

## Development

Install the development dependencies and start the Sass watcher:

```bash
npm install
npm run dev
```

Generate optimized production CSS with:

```bash
npm run build
```

SCSS formatting runs automatically before the `dev` and `build` commands. It can
also be applied or checked separately:

```bash
npm run format:scss
npm run format:check
```

## Editable content

- **Appearance → Customize**: hero content, biography, images, contact details, and social links.
- **Videos**: title, YouTube URL or ID, type, and duration.
- **Agenda**: event name, date, and city.
- **Appearance → Menus**: primary navigation.

The theme displays fallback content until videos or live shows are created in WordPress.
