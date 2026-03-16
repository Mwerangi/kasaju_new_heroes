# About Page - Dynamic Content Management Guide

## Overview

The About Us page is now **fully dynamic** and can be edited through the admin panel. All content is stored in the database and rendered from the `pages` and `page_sections` tables.

## How It Works

### Database Structure

1. **Page**: The main "About Us" page (slug: `about`)
2. **Page Sections**: 9 different sections that make up the page content

### Available Sections

| Section Key | Purpose | Data Type |
|------------|---------|-----------|
| `hero` | Page header with title and subtitle | Text fields |
| `overview` | Company overview/description | HTML content |
| `mission` | Mission statement | HTML content |
| `vision` | Vision statement | HTML content |
| `values` | Core values (multiple items) | JSON array |
| `services` | What we do (multiple items) | JSON array |
| `why_choose` | Why choose us (multiple items) | JSON array |
| `industries` | Industries served (multiple items) | JSON array |
| `commitment` | Closing commitment statement | HTML content |

## Editing Content

### Simple Text Sections (hero, overview, mission, vision, commitment)

1. Go to **Admin Dashboard** → **Pages**
2. Click **Edit** on "About Us"
3. Click **Edit** on the section you want to modify
4. Update the fields:
   - **Title**: Main heading
   - **Subtitle**: Subheading (optional)
   - **Content**: Main text (supports HTML)
5. Click **Update Section**

### Complex Sections with Multiple Items (values, services, why_choose, industries)

These sections use **JSON arrays** stored in the `additional_data` field.

#### Structure Examples

**Core Values** (section_key: `values`):
```json
[
  {
    "icon": "fa-balance-scale",
    "color": "green",
    "title": "Integrity",
    "description": "We conduct our business with honesty..."
  },
  {
    "icon": "fa-user-tie",
    "color": "blue",
    "title": "Professionalism",
    "description": "We maintain high standards..."
  }
]
```

**What We Do** (section_key: `services`):
```json
[
  {
    "icon": "fa-car",
    "title": "Motor Vehicle Clearing",
    "description": "Professional clearance services..."
  }
]
```

**Why Choose Us** (section_key: `why_choose`):
```json
[
  {
    "icon": "fa-users",
    "color": "blue",
    "title": "Experienced Team",
    "description": "Our team has strong knowledge..."
  }
]
```

**Industries** (section_key: `industries`):
```json
[
  {
    "icon": "fa-car-side",
    "color": "blue",
    "title": "Vehicle Importers"
  }
]
```

### How to Edit JSON Sections

1. Navigate to the section in admin panel
2. Find the **Additional Data (JSON)** field
3. Edit the JSON carefully (maintain the structure)
4. Click **"Validate JSON"** link to check for errors
5. If valid, click **Update Section**

### JSON Field Reference

| Field | Required | Description | Example |
|-------|----------|-------------|---------|
| `icon` | Yes | FontAwesome icon class | `fa-star`, `fa-car` |
| `color` | Optional | Color theme | `blue`, `green`, `red`, `orange`, `purple`, `yellow` |
| `title` | Yes | Item title | "Integrity", "Motor Vehicle Clearing" |
| `description` | Optional | Item description | "We conduct our business..." |

## Icon Reference

Use FontAwesome 5 icons. Common icons:

- **Values**: `fa-balance-scale`, `fa-user-tie`, `fa-bolt`, `fa-handshake`, `fa-shield-alt`, `fa-star`
- **Services**: `fa-car`, `fa-truck-monster`, `fa-file-contract`, `fa-ship`, `fa-shipping-fast`, `fa-comments`
- **Reasons**: `fa-users`, `fa-tachometer-alt`, `fa-medal`, `fa-truck`
- **Industries**: `fa-car-side`, `fa-hard-hat`, `fa-cogs`, `fa-truck-loading`, `fa-tools`, `fa-user`

Find more icons at: https://fontawesome.com/v5/search

## Color Options

Available colors for icons:
- `blue` - Primary brand color
- `green` - Success/growth
- `orange` - Energy/warmth
- `purple` - Premium/quality
- `red` - Important/urgent
- `yellow` - Optimism/bright

## Tips

1. **Always validate JSON** before saving to avoid errors
2. **Backup before major changes** - copy the JSON to a text file
3. **Test changes** - view the About page after editing
4. **Keep structure consistent** - don't add/remove required fields
5. **Use clear titles** - they appear as headings on the page

## Troubleshooting

### Page shows no content
- Check if the page is marked as "Active" in admin
- Verify sections are marked as "Active"

### JSON errors when saving
- Use the "Validate JSON" button
- Check for missing commas, quotes, or brackets
- Ensure proper escaping of special characters

### Section not appearing
- Verify `is_active` is checked
- Check the `order` field (lower numbers appear first)

## Technical Notes

- Controller: `App\Http\Controllers\Web\AboutController`
- Admin Controller: `App\Http\Controllers\Admin\PageSectionController`
- View: `resources/views/web/about.blade.php`
- Model: `App\Models\PageSection`
- Seeder: `database/seeders/PageSeeder.php`

---

**Last Updated**: March 13, 2026
