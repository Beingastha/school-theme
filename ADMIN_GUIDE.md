# Subhash Excellence School — Website Owner & Admin Guide

Welcome to your website management guide! This document is designed for the school administrator and website owner to understand how to update text, upload images, manage dynamic sections, and toggle layouts without touching any code.

---

## 🧭 Dashboard Quick Reference

When you log into your WordPress Dashboard (`/wp-admin`), you will see three main hubs for managing your site's content:

1. **Page Content** (Custom Admin Sidebar Menu): For editing standard page text, titles, subtitles, and button links.
2. **Appearance > Customize > School Settings**: For managing global settings like contact details, statistics, the principal's message, logo, and active hero layout.
3. **Custom Post Types** (Sidebar Menus): For adding, editing, or removing dynamic card sections:
   - **Why Choose Us** (`esb_feature`): Reorderable cards explaining school highlights (Academic Rigour, Infrastructure, etc.).
   - **News & Events** (`esb_news`): Megaphone updates shown on the home page.
   - **Moments from Our Campus** (`esb_gallery`): Photo gallery mosaic.
   - **Facilities** (`esb_facility`): School laboratories, classrooms, and hostels.
   - **Achievements** (`esb_achievement`): School and student awards.
   - **Testimonials** (`esb_testimonial`): Student and parent reviews.

---

## 📝 Editing Text Content

All main page content is editable directly in the WordPress dashboard.

### 1. Header, Footer, and Contact Details
These are global settings managed via the WordPress Customizer:
1. Navigate to **Appearance** > **Customize** in your WordPress sidebar.
2. Click on the **School Settings** panel. Here you will find sections for:
   - **School Identity**: Edit the Legal Name, Short Name (header), Tagline, UDISE Code, and Affiliation details.
   - **Contact Information**: Edit the phone number, email, address, operating hours, and Google Maps embed link.
   - **Social Media Links**: Edit Facebook, Instagram, LinkedIn, and YouTube page links.
   - **Key Statistics**: Update the mini-stats shown in the hero section (board pass rate, student count, etc.).
   - **Principal's Message**: Update the Principal's name, role/title, quote, and upload a portrait.
3. Click **Publish** at the top to save your changes.

### 2. Main Page Headlines, Paragraphs, and CTA Buttons
For on-page paragraphs and headings, we have created a dedicated management dashboard:
1. Click **Page Content** in the left sidebar of your WordPress admin panel.
2. Use the tabs at the top to select the page you want to edit:
   - **🏠 Home**: Edit section headings, body text, and CTA buttons.
   - **ℹ️ About**: Edit "Our Story" paragraphs, mission and vision text, and values list.
   - **📚 Academics**: Edit curricular streams, academic policies, and admission links.
   - **📋 Admissions**: Edit registration deadlines, steps for application, and requirements.
3. Edit the fields as desired and click **Save Changes**.

---

## 📊 Board Results (Academic Excellence)

The statistics bar graphs (percentages) and descriptions under the "Academic Excellence" section are managed directly in the Customizer:
1. Go to **Appearance** > **Customize** > **School Settings** > **Board Results**.
2. **Results Paragraph**: Edit the English and Hindi description paragraphs showing on the right of the results graph.
3. **Graph Bars (1-4)**: For each of the 4 bar items, you can customize:
   - **Bar Name (English)** (e.g. *Class XII · Science*)
   - **Bar Name (Hindi)** (e.g. *कक्षा 12 · विज्ञान*)
   - **Bar Percentage (0-100)** (e.g. *99*)
4. Click **Publish**.

---

## 🖼️ Student Life Mosaic Images & Captions

The 6-tile image collage under "Student Life & Activities" is fully managed in the Customizer:
1. Go to **Appearance** > **Customize** > **School Settings** > **Student Life Mosaic**.
2. For each of the 6 tiles in the collage, you can customize:
   - **Tile Image**: Click **Select Image** to upload a photo. If left blank, the theme will automatically search your Media Library for fallback images with matching filenames (like `cultural`, `teachers-group`, `teacher`, `academics-lab`, or `sports`).
   - **Tile Caption (English)** (e.g. *NCC*, *Debate*, *Science Fair*)
   - **Tile Caption (Hindi)** (e.g. *एनसीसी*, *वाद-विवाद*)
3. Click **Publish**.

---

## 🔄 Dynamic Sections & Fallback Behaviors

For sections containing card grids, you can add, edit, or delete items using standard WordPress menus.

### 1. Why Choose Us Cards (CPT override)
* **What are the default cards?**
  To keep the page looking complete, the theme has 6 pre-configured static features built-in (Academic Rigour, Modern Infrastructure, etc.).
  - **Editing Default Cards**: If you choose not to use the custom post type yet, you can edit the English titles and descriptions of the 6 default cards in the **Page Content** dashboard under the **🏠 Home** tab. The Hindi translations for these default cards utilize integrated defaults in the template file.
* **How to customize features (Recommended)**:
  1. Click on **Why Choose Us** in your sidebar and click **Add Feature Card**.
  2. Enter the English title in the main title input and write the English description in the main editor.
  3. Expand the **Hindi Translation** box below the editor:
     - **Hindi Title** (e.g. *शैक्षणिक कठोरता*)
     - **Hindi Description** (e.g. *विज्ञान, वाणिज्य और मानविकी में...*)
  4. In the **Page Attributes** box on the right, set the **Order** value (e.g. `1`, `2`, `3`...) to determine the layout position.
  5. Click **Publish**.

  > [!IMPORTANT]
  > As soon as you publish **at least one** card in the dashboard, the 6 static default features will be completely disabled, and only your custom published cards will show on the frontend.

### 2. Testimonials (Fallback & CPT override)
* **Why do Testimonials show up when the CPT menu is empty?**
  The theme has 3 pre-configured static testimonials built-in.
* **How to customize testimonials:**
  1. Click on **Testimonials** > **Add Testimonial**.
  2. Enter the quote text in the main text editor.
  3. Fill in the **Testimonial Details** fields at the bottom:
     - **Author Name** (e.g. *Ananya Sharma*)
     - **Role / Batch** (e.g. *Student, Class XII Science*)
     - **Initials** (e.g. *AS*)
  4. Click **Publish** to disable the default static reviews and show your custom ones.

### 3. Moments from Our Campus (Gallery)
- **Add Gallery Photo**: Click **Gallery Photos** > **Add Gallery Photo**. Enter a descriptive title and set the **Featured Image** on the right.
- **Grid Size**: Use the **Gallery Options** meta box below the editor to choose if a photo should be a standard **Normal (1x1)** tile or a **Tall (1x2)** tile.
- **Remove Gallery Photo**: Click **Gallery Photos**, hover over the photo, and click **Trash**.

### 4. Campus Facilities & Labs
- **Add Facility**: Click **Facilities** > **Add Facility**. Write the facility name (e.g., *Physics Lab*), write a description, and assign a **Featured Image**.
- **Remove/Modify Facility**: Hover over any item in the list to edit its details or delete it.

### 5. Student & School Achievements
- **Add Achievement**: Click **Achievements** > **Add Achievement**. Write the title, description, and upload a **Featured Image** (e.g., photo of the trophy/event).

---

## 🛑 Removing or Hiding Entire Homepage Sections

If you want to hide an entire block from the home page (such as disabling the Testimonials or the Principal's message entirely):
1. Because the homepage uses a clean PHP modular template, you can enable or disable sections by opening the file [front-page.php](file:///Users/astha/Documents/WP%20Themes/excellence-school/theme/front-page.php).
2. Locate the line corresponding to the section you want to hide, for example:
   ```php
   <?php get_template_part( 'template-parts/sections/testimonials' ); ?>
   ```
3. To disable it, comment it out by adding `//` before the function call, like this:
   ```php
   <?php // get_template_part( 'template-parts/sections/testimonials' ); ?>
   ```
4. To reactivate the section, remove the `//` and save the file.
