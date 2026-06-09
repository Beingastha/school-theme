# Subhash Excellence School — Website Owner & Admin Guide

Welcome to your website management guide! This document is designed for the school administrator and website owner to understand how to update text, upload images, manage dynamic sections, and toggle layouts without touching any code.

---

## 🧭 Dashboard Quick Reference

When you log into your WordPress Dashboard (`/wp-admin`), you will see three main hubs for managing your site's content:

1. **Page Content** (Custom Admin Sidebar Menu): For editing standard page text, titles, subtitles, card descriptions, and button links.
2. **Appearance > Customize > School Settings**: For managing global settings like contact details, statistics, the principal's message, logo, and active hero layout.
3. **Custom Post Types** (Sidebar Menus): For adding, editing, or removing dynamic items like News & Events, Campus Gallery Photos, Achievements, and Building Facilities.

---

## 📝 Editing Text Content

All main page content is editable directly in the WordPress dashboard without page builders.

### 1. Header, Footer, and Contact Details
These are global settings managed via the WordPress Customizer:
1. Navigate to **Appearance** > **Customize** in your WordPress sidebar.
2. Click on the **School Settings** panel. Here you will find sections for:
   - **School Identity**: Edit the Legal Name, Short Name (header), Tagline, UDISE Code, and Affiliation details.
   - **Contact Information**: Edit the phone number, email, address, operating hours, and Google Maps embed link.
   - **Social Media Links**: Edit Facebook, Instagram, LinkedIn, and YouTube page links.
   - **Key Statistics**: Update the board pass rate, student count, faculty size, and awards count.
   - **Principal's Message**: Update the Principal's name, role/title, quotation text, and upload a portrait photo.
3. Click **Publish** at the top to save your changes.

### 2. Main Page Headlines, Paragraphs, and CTA Buttons
For on-page paragraphs and headings, we have created a dedicated management dashboard:
1. Click **Page Content** in the left sidebar of your WordPress admin panel.
2. Use the tabs at the top to select the page you want to edit:
   - **🏠 Home**: Edit section headings (like "Why Choose Us" or "Academic Excellence"), body text, and CTA buttons.
   - **ℹ️ About**: Edit "Our Story" paragraphs, mission and vision text, and values list.
   - **📚 Academics**: Edit curricular streams, academic policies, and admission links.
   - **📋 Admissions**: Edit registration deadlines, steps for application, and requirements.
3. Edit the fields as desired and click **Save Changes**.

> [!NOTE]
> **Bilingual (EN / HI) Translations**: The English text you enter in the Page Content dashboard is used as the default. The Hindi layout uses built-in default translations in the theme template files. When a visitor clicks the language toggle in the header, the website dynamically translates the layouts.

---

## 🖼️ Managing Images and Photos

### 1. Hero Background / Watermark Image
To change the background watermark on the homepage hero variant:
1. Go to **Appearance** > **Customize** > **School Settings** > **Appearance & Hero**.
2. Under **Hero Background / Campus Image**, click **Select Image** to upload a new one or choose from your Media Library.
3. Click **Publish**.

### 2. Principal Portrait
To update the Principal's photo:
1. Go to **Appearance** > **Customize** > **School Settings** > **Principal's Message**.
2. Click **Select Image** under the portrait control to replace the photo.
3. Click **Publish**.

### 3. Inner Page Feature Images (Story & Admissions Desk)
- **About Page Story Image**: Managed in **Appearance > Customize > School Settings > Appearance & Hero** under **About Page Heritage Image**.
- **Admissions Page Sidebar Image**: Managed in **Appearance > Customize > School Settings > Appearance & Hero** under **Admissions Desk Image**.

---

## 🔄 Dynamic Sections & Fallback Behaviors

For sections containing card grids, you can add, edit, or delete items using standard WordPress menus.

### 1. Testimonials (Fallback & CPT override)
* **Why do Testimonials show up when the CPT menu is empty?**
  To keep the page looking complete, the theme has 3 pre-configured static testimonials built-in (Ananya Sharma, Rajesh Kumar Verma, and Priya Patel). 
* **How to customize testimonials:**
  1. Click on **Testimonials** in your wp-admin sidebar and click **Add Testimonial**.
  2. Enter the quote text in the main text editor.
  3. Fill in the **Testimonial Details** fields at the bottom:
     - **Author Name** (e.g. *Ananya Sharma*)
     - **Role / Batch** (e.g. *Student, Class XII Science*)
     - **Initials** (e.g. *AS*)
  4. Click **Publish**.
  
  > [!IMPORTANT]
  > As soon as you publish **at least one** testimonial in the dashboard, the 3 static default testimonials will be completely disabled, and only your custom published testimonials will show on the frontend.

### 2. Moments from Our Campus (Gallery)
- **Add Gallery Photo**: Click **Gallery Photos** > **Add Gallery Photo**. Enter a descriptive title and set the **Featured Image** on the right.
- **Grid Size**: Use the **Gallery Options** meta box below the editor to choose if a photo should be a standard **Normal (1x1)** tile or a **Tall (1x2)** tile.
- **Remove Gallery Photo**: Click **Gallery Photos**, hover over the photo, and click **Trash**.

### 3. Campus Facilities & Labs
- **Add Facility**: Click **Facilities** > **Add Facility**. Write the facility name (e.g., *Physics Lab*), write a description, and assign a **Featured Image**.
- **Remove/Modify Facility**: Hover over any item in the list to edit its details or delete it.

### 4. Student & School Achievements
- **Add Achievement**: Click **Achievements** > **Add Achievement**. Write the title, description, and upload a **Featured Image** (e.g., photo of the trophy/event).

---

## 🛠️ Editing Specialty Template Sections

Some sections are styled statically within template files to ensure high-performance rendering:

### 1. Board Results (Academic Excellence)
The percentages (99%, 98%, 97%, 96%) and stream labels shown in this bar graph are managed directly in the template file [academic-excellence.php](file:///Users/astha/Documents/WP%20Themes/excellence-school/theme/template-parts/sections/academic-excellence.php):
- Open the template file and locate the `$bars` array near the top:
  ```php
  $bars = [
      [ 'en' => 'Class XII · Science',    'hi' => 'कक्षा 12 · विज्ञान',  'pct' => 99 ],
      [ 'en' => 'Class XII · Commerce',   'hi' => 'कक्षा 12 · वाणिज्य', 'pct' => 98 ],
      ...
  ];
  ```
- You can change the titles or modify the `'pct'` numbers (e.g., change `99` to `95`). Save the file and deploy to push changes live.

### 2. Student Life Mosaic Images
The labels ("Annual Day", "NCC", etc.) and layout grids are set in the template file [student-life.php](file:///Users/astha/Documents/WP%20Themes/excellence-school/theme/template-parts/sections/student-life.php). 
- To replace the images in the mosaic:
  1. Upload your new images to the WordPress **Media Library**.
  2. Edit each image in the Media Library and set its **Alternative Text** or **File Title** to match one of these key terms:
     - `cultural` (replaces Annual Day and Cultural tiles)
     - `teachers-group` (replaces NCC tile)
     - `teacher` (replaces Debate tile)
     - `academics-lab` (replaces Science Fair tile)
     - `sports` (replaces Sports Meet tile)
  3. The theme will automatically locate and render these images.

### 3. Why Choose Us Card Details
- **English Titles and Descriptions**: Go to the **Page Content** dashboard under the **Home** tab to edit all 6 card titles and text paragraphs.
- **Hindi Titles and Descriptions**: The Hindi fallbacks are built into [why-choose-us.php](file:///Users/astha/Documents/WP%20Themes/excellence-school/theme/template-parts/sections/why-choose-us.php) and will display when the language toggle is switched to Hindi.

---

## 🗺️ Editing Navigation Menus

To update the main navigation links at the top of the header or in the footer:
1. Go to **Appearance** > **Menus**.
2. In the dropdown, select the menu you want to edit (e.g., **Primary Menu** for the header, or **Mobile Drawer Menu**).
3. **Add Links**: Select pages from the left column and click **Add to Menu**. Drag and drop them to reorder.
4. **Bilingual Navigation Labels**: Expand any menu item by clicking the down arrow. 
   - **English Label**: Edit the **Navigation Label** input.
   - **Hindi Label**: Enter the Hindi translation in the **Description** field. (The theme's menu walker will bind it to the Hindi translation tag).
5. Click **Save Menu**.

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
4. To reactivate the section, simply remove the `//` and save the file.
5. Push the file to the live site.
