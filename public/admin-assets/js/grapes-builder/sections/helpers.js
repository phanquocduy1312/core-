/**
 * GrapesJS Sections Helper Utilities, Centralized Breakpoints & Self-Sufficient Semantic CSS
 */
(function (global) {
    'use strict';

    var BREAKPOINTS = {
        tablet: 992,
        columnStack: 768,
        mobile: 480
    };

    function uid(prefix) {
        if (global.GrapesIdManager && global.GrapesIdManager.generateId) {
            return global.GrapesIdManager.generateId(prefix);
        }
        return (prefix || 'sec') + '-' + Math.random().toString(36).substring(2, 7);
    }

    function placeholderImage(alt, mediaRef, extraClasses) {
        var cls = ['builder-img', 'builder-rounded-2xl'];
        if (extraClasses) {
            if (Array.isArray(extraClasses)) cls = cls.concat(extraClasses);
            else cls.push(extraClasses);
        }
        return {
            type: 'image',
            tagName: 'img',
            attributes: {
                src: '/admin-assets/images/builder/hero-placeholder.svg',
                alt: alt || 'Hình ảnh minh họa',
                loading: 'lazy'
            },
            mediaRef: mediaRef || 'general/hero-placeholder',
            classes: cls
        };
    }

    // Complete, self-sufficient semantic CSS for all Section variants & components
    var SHARED_SECTION_CSS = `
/* Layout & Container Foundation */
.builder-section {
  position: relative;
  width: 100%;
  overflow: hidden;
  box-sizing: border-box;
}
.builder-container {
  width: 100%;
  margin-left: auto;
  margin-right: auto;
  max-width: 1280px;
  padding-left: 20px;
  padding-right: 20px;
  box-sizing: border-box;
}
.builder-container-sm { max-width: 800px; }
.builder-container-md { max-width: 1024px; }

/* Flex & Grid Layouts */
.builder-stack { display: flex; box-sizing: border-box; }
.builder-flex-col { flex-direction: column; }
.builder-flex-row { flex-direction: row; }
.builder-align-center { align-items: center; }
.builder-justify-center { justify-content: center; }
.builder-justify-end { justify-content: flex-end; }
.builder-text-center { text-align: center; }
.builder-gap-2 { gap: 8px; }
.builder-gap-3 { gap: 12px; }
.builder-gap-4 { gap: 16px; }
.builder-gap-5 { gap: 20px; }
.builder-gap-6 { gap: 24px; }
.builder-gap-8 { gap: 32px; }
.builder-mb-8 { margin-bottom: 32px; }
.builder-mb-10 { margin-bottom: 40px; }
.builder-mb-12 { margin-bottom: 48px; }
.builder-w-full { width: 100%; }

.builder-columns-2 {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 40px;
  align-items: center;
}
.builder-columns-split {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 32px;
  align-items: center;
}
.builder-grid-2 {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 20px;
}
.builder-grid-3 {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 32px;
}
.builder-grid-4 {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 20px;
}

/* Typography Foundation */
.section-title {
  font-size: 36px;
  font-weight: 700;
  color: #0f172a;
  line-height: 1.25;
  margin: 0 0 12px 0;
}
.section-title-white { color: #ffffff; }
.section-description {
  font-size: 16px;
  color: #475569;
  line-height: 1.6;
  margin: 0;
}
.section-description-light { color: #cbd5e1; }

/* Image Base */
.builder-img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}
.builder-rounded-2xl { border-radius: 16px; }
.builder-shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08); }
.builder-shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }

/* Buttons */
.builder-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 12px 28px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.2s ease;
  cursor: pointer;
}
.builder-btn-primary {
  background-color: #e32326;
  color: #ffffff;
  border: 1px solid transparent;
}
.builder-btn-primary:hover { background-color: #cc1b1e; }
.builder-btn-secondary {
  background-color: #ffffff;
  color: #0f172a;
  border: 1px solid #cbd5e1;
}
.builder-btn-secondary:hover { background-color: #f8fafc; }
.builder-btn-outline {
  background-color: transparent;
  color: #e32326;
  border: none;
  padding: 0;
  font-weight: 600;
}

/* SECTION VARIANTS */

/* Hero 01 & 02 */
.section-hero-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #f8fafc;
}
.hero-title {
  font-size: 44px;
  font-weight: 800;
  color: #0f172a;
  line-height: 1.2;
  margin: 0;
}
.section-hero-02 {
  padding-top: 100px;
  padding-bottom: 100px;
  background-color: #0f172a;
  color: #ffffff;
  text-align: center;
}
.hero-title-center {
  font-size: 48px;
  font-weight: 800;
  color: #ffffff;
  line-height: 1.2;
  margin: 0;
}

/* About 01 & 02 */
.section-about-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #ffffff;
}
.section-about-02 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #f8fafc;
}
.builder-stat-card {
  padding: 24px;
  background-color: #ffffff;
  border-radius: 16px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.stat-value {
  font-size: 32px;
  font-weight: 800;
  color: #e32326;
  margin: 0 0 4px 0;
}
.stat-label {
  font-size: 13px;
  font-weight: 600;
  color: #64748b;
  margin: 0;
}

/* Services 01 & 02 */
.section-services-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #f8fafc;
}
.section-services-02 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #ffffff;
}
.builder-service-card {
  padding: 32px;
  background-color: #ffffff;
  border-radius: 16px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
  gap: 16px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.builder-service-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
}
.service-icon {
  font-size: 40px;
  color: #e32326;
}
.service-title {
  font-size: 20px;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
}

/* Projects 01 & 02 */
.section-projects-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #ffffff;
}
.section-projects-02 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #f8fafc;
}
.builder-project-card {
  background-color: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #f1f5f9;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
}
.project-card-body {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.project-category {
  font-size: 12px;
  font-weight: 700;
  color: #e32326;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin: 0;
}
.project-title {
  font-size: 18px;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
}

/* Gallery 01 & 02 */
.section-gallery-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #ffffff;
}
.section-gallery-02 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #f8fafc;
}
.builder-gallery-img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
  border-radius: 16px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  transition: transform 0.3s ease;
  cursor: pointer;
}
.builder-gallery-img:hover {
  transform: scale(1.02);
}

/* CTA 01 & 02 */
.section-cta-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #0f172a;
  color: #ffffff;
  text-align: center;
}
.section-cta-02 {
  padding-top: 64px;
  padding-bottom: 64px;
  background-color: #f8fafc;
}

/* Contact 01 & 02 */
.section-contact-01 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #ffffff;
}
.section-contact-02 {
  padding-top: 80px;
  padding-bottom: 80px;
  background-color: #f8fafc;
}
.contact-info-row {
  display: flex;
  flex-direction: row;
  gap: 12px;
  align-items: center;
}
.contact-icon {
  font-size: 24px;
  color: #e32326;
  flex-shrink: 0;
}
.contact-text {
  font-size: 16px;
  font-weight: 600;
  color: #0f172a;
  margin: 0;
}
.builder-contact-box {
  padding: 32px;
  background-color: #f8fafc;
  border-radius: 16px;
  border: 1px solid #e2e8f0;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.builder-contact-card {
  padding: 32px;
  background-color: #ffffff;
  border-radius: 16px;
  border: 1px solid #f1f5f9;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
}

/* Responsive Media Queries */
@media (max-width: 992px) {
  .builder-grid-3, .builder-grid-4 {
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
  }
}

@media (max-width: 768px) {
  .builder-columns-2, .builder-columns-split {
    grid-template-columns: 1fr !important;
  }
  .hero-title, .hero-title-center {
    font-size: 36px !important;
  }
  .section-title {
    font-size: 28px !important;
  }
}

@media (max-width: 480px) {
  .builder-section {
    padding-top: 48px !important;
    padding-bottom: 48px !important;
  }
  .builder-grid-2, .builder-grid-3, .builder-grid-4 {
    grid-template-columns: 1fr !important;
  }
  .hero-title, .hero-title-center {
    font-size: 30px !important;
  }
}
`;

    global.GrapesSectionHelpers = {
        BREAKPOINTS: BREAKPOINTS,
        uid: uid,
        placeholderImage: placeholderImage,
        SHARED_SECTION_CSS: SHARED_SECTION_CSS
    };
})(window);
