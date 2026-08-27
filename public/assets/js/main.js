/**
 * BÁCH ANH GROUP - Main Interactive JavaScript
 * Includes Advanced Client-Side Product Pagination, Searching & Sorting
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initStickyHeader();
  initProductFilter();
  initModals();
  initProductDetailPage();
  initProductCardLinks();
  initFormHandlers();
  initCounterAnim();
  initHeroSlider();
});

// Mobile Menu Toggle
function initMobileMenu() {
  const menuBtn = document.getElementById('mobile-menu-btn');
  const closeBtn = document.getElementById('mobile-menu-close');
  const drawer = document.getElementById('mobile-drawer');
  const backdrop = document.getElementById('mobile-backdrop');

  if (!menuBtn || !drawer) return;

  const toggleMenu = (show) => {
    if (show) {
      drawer.classList.remove('translate-x-full');
      if (backdrop) backdrop.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    } else {
      drawer.classList.add('translate-x-full');
      if (backdrop) backdrop.classList.add('hidden');
      document.body.style.overflow = '';
    }
  };

  menuBtn.addEventListener('click', () => toggleMenu(true));
  if (closeBtn) closeBtn.addEventListener('click', () => toggleMenu(false));
  if (backdrop) backdrop.addEventListener('click', () => toggleMenu(false));

  // Auto-close drawer on link click
  const drawerLinks = drawer.querySelectorAll('a');
  drawerLinks.forEach(link => {
    link.addEventListener('click', () => toggleMenu(false));
  });
}

// Sticky Header Adjustment
function initStickyHeader() {
  const topbar = document.getElementById('topbar');
  const navbar = document.getElementById('main-navbar');
  if (!navbar) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      if (topbar) topbar.classList.add('hidden');
      navbar.classList.add('py-2');
      navbar.classList.remove('py-3.5');
    } else {
      if (topbar) topbar.classList.remove('hidden');
      navbar.classList.remove('py-2');
      navbar.classList.add('py-3.5');
    }
  });
}

// Advanced Product Filtering, Searching, Sorting & Client-Side Pagination
function initProductFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const brandBtns = document.querySelectorAll('.brand-filter-btn');
  const productItems = document.querySelectorAll('.product-item');
  const searchInput = document.getElementById('product-search-input');
  const sortSelect = document.getElementById('product-sort-select');
  const visibleCountEl = document.getElementById('visible-count');
  const paginationContainer = document.getElementById('pagination-container');
  const productsContainer = document.getElementById('products-container');

  if (productItems.length === 0 || !productsContainer) return;

  const urlParams = new URLSearchParams(window.location.search);
  let activeCategory = urlParams.get('filter') || 'all';
  
  const brandAliases = {
    bastionsenergy: 'bastions',
    bastion: 'bastions',
    longisolar: 'longi',
    deyesolar: 'deye',
    luxpowertek: 'luxpower',
    xinpzenergy: 'xinpz',
    canadiansolar: 'canadian',
    jinkosolar: 'jinko',
    vsunsolar: 'vsun',
    solisginlong: 'solis',
    ginlongsolis: 'solis',
    goodweeu: 'goodwe',
    hina: 'hinaess',
    chisage: 'chisageess'
  };

  let rawBrand = (urlParams.get('brand') || 'all').trim().toLowerCase();
  let activeBrand = brandAliases[rawBrand] || rawBrand;

  let searchQuery = '';
  let itemsPerPage = 8;
  let currentPage = 1;

  if (urlParams.has('brand')) {
    activeCategory = 'all';
  }

  const renderPagination = (totalPages, totalFiltered) => {
    if (!paginationContainer) return;
    paginationContainer.innerHTML = '';

    if (totalFiltered === 0 || totalPages <= 1) {
      return;
    }

    const nav = document.createElement('div');
    nav.className = 'flex items-center justify-center gap-1.5 sm:gap-2 pt-8 mt-8 border-t border-slate-200/80 flex-wrap';

    const prevBtn = document.createElement('button');
    prevBtn.className = `px-3 sm:px-4 py-2 h-9 sm:h-10 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 flex-shrink-0 ${
      currentPage === 1
        ? 'bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200'
        : 'bg-white text-slate-700 hover:bg-blue-600 hover:text-white border border-slate-200/90 shadow-sm'
    }`;
    prevBtn.innerHTML = `<i class="fas fa-chevron-left text-[10px]"></i> <span>Trang Trước</span>`;
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        updateGrid(true);
      }
    });
    nav.appendChild(prevBtn);

    const getPageNumbers = () => {
      if (totalPages <= 7) {
        return Array.from({ length: totalPages }, (_, i) => i + 1);
      }
      if (currentPage <= 4) {
        return [1, 2, 3, 4, 5, '...', totalPages];
      }
      if (currentPage >= totalPages - 3) {
        return [1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
      }
      return [1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages];
    };

    const pages = getPageNumbers();

    pages.forEach(p => {
      if (p === '...') {
        const dots = document.createElement('span');
        dots.className = 'w-7 h-9 sm:h-10 flex items-center justify-center text-slate-400 font-extrabold text-xs select-none';
        dots.textContent = '...';
        nav.appendChild(dots);
      } else {
        const pageBtn = document.createElement('button');
        pageBtn.className = `w-9 h-9 sm:w-10 sm:h-10 rounded-xl text-xs sm:text-sm font-extrabold transition-all flex items-center justify-center flex-shrink-0 ${
          p === currentPage
            ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30 border border-blue-600 scale-105'
            : 'bg-white text-slate-700 hover:bg-blue-50 hover:text-blue-600 border border-slate-200/90 shadow-sm'
        }`;
        pageBtn.textContent = p;
        pageBtn.addEventListener('click', (e) => {
          e.preventDefault();
          if (currentPage !== p) {
            currentPage = p;
            updateGrid(true);
          }
        });
        nav.appendChild(pageBtn);
      }
    });

    const nextBtn = document.createElement('button');
    nextBtn.className = `px-3 sm:px-4 py-2 h-9 sm:h-10 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 flex-shrink-0 ${
      currentPage === totalPages
        ? 'bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200'
        : 'bg-white text-slate-700 hover:bg-blue-600 hover:text-white border border-slate-200/90 shadow-sm'
    }`;
    nextBtn.innerHTML = `<span>Trang Sau</span> <i class="fas fa-chevron-right text-[10px]"></i>`;
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage < totalPages) {
        currentPage++;
        updateGrid(true);
      }
    });
    nav.appendChild(nextBtn);

    paginationContainer.appendChild(nav);
  };

  const updateGrid = (shouldScroll = false) => {
    const matchedItems = [];
    productItems.forEach(item => {
      const category = (item.getAttribute('data-category') || '').toLowerCase();
      const brand = (item.getAttribute('data-brand') || '').toLowerCase();
      const title = (item.querySelector('h3') ? item.querySelector('h3').textContent : '').toLowerCase();
      const desc = (item.querySelector('p') ? item.querySelector('p').textContent : '').toLowerCase();

      const matchCategory = (
        activeCategory === 'all' || 
        activeCategory === 'solar' ||
        category === activeCategory ||
        (activeCategory === 'accessory' && (category === 'accessory' || category === 'accessories')) ||
        (activeCategory === 'accessories' && (category === 'accessory' || category === 'accessories'))
      );
      
      const normActiveBrand = activeBrand.toLowerCase();
      const matchBrand = (normActiveBrand === 'all') || 
                         (brand === normActiveBrand) ||
                         (brand.length > 0 && normActiveBrand.length > 0 && (brand.includes(normActiveBrand) || normActiveBrand.includes(brand))) ||
                         (title.includes(normActiveBrand)) ||
                         (desc.includes(normActiveBrand)) ||
                         (normActiveBrand.includes('canadian') && (title.includes('canadian') || brand.includes('canadian'))) ||
                         (normActiveBrand.includes('chisage') && (title.includes('chisage') || brand.includes('chisage'))) ||
                         (normActiveBrand.includes('hina') && (title.includes('hina') || brand.includes('hina'))) ||
                         (normActiveBrand.includes('bastions') && (title.includes('bastions') || brand.includes('bastions')));

      const matchSearch = searchQuery === '' || title.includes(searchQuery) || desc.includes(searchQuery);

      if (matchCategory && matchBrand && matchSearch) {
        matchedItems.push(item);
      }
    });

    if (sortSelect && sortSelect.value !== 'default') {
      matchedItems.sort((a, b) => {
        const tA = (a.querySelector('h3') ? a.querySelector('h3').textContent : '').trim();
        const tB = (b.querySelector('h3') ? b.querySelector('h3').textContent : '').trim();
        if (sortSelect.value === 'az') return tA.localeCompare(tB, 'vi');
        if (sortSelect.value === 'za') return tB.localeCompare(tA, 'vi');
        return 0;
      });
    }

    const totalFiltered = matchedItems.length;
    const totalPages = Math.ceil(totalFiltered / itemsPerPage) || 1;

    if (currentPage > totalPages) {
      currentPage = 1;
    }

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    productItems.forEach(item => {
      item.style.display = 'none';
    });

    const currentPageItems = matchedItems.slice(startIndex, endIndex);
    currentPageItems.forEach(item => {
      item.style.display = 'flex';
      if (productsContainer) {
        productsContainer.appendChild(item);
      }
    });

    if (visibleCountEl) {
      if (totalFiltered === 0) {
        visibleCountEl.textContent = '0';
      } else {
        const displayStart = startIndex + 1;
        const displayEnd = Math.min(endIndex, totalFiltered);
        visibleCountEl.textContent = `${displayStart}-${displayEnd} trên tổng ${totalFiltered}`;
      }
    }

    filterBtns.forEach(b => {
      const cat = b.getAttribute('data-filter');
      if (cat === activeCategory || (activeCategory === 'all' && cat === 'all')) {
        b.classList.add('bg-blue-600', 'text-white', 'shadow-md');
        b.classList.remove('bg-white', 'text-slate-700');
      } else {
        b.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
        b.classList.add('bg-white', 'text-slate-700');
      }
    });

    const normActiveBrand = activeBrand.toLowerCase();
    let isMoreBrandActive = false;
    brandBtns.forEach(b => {
      const brd = (b.getAttribute('data-brand') || '').toLowerCase();
      if (brd === normActiveBrand) {
        b.classList.add('bg-blue-600', 'text-white', 'shadow-md');
        b.classList.remove('bg-white', 'text-slate-700');
        if (b.closest('#more-brands-wrapper')) {
          isMoreBrandActive = true;
        }
      } else {
        b.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
        b.classList.add('bg-white', 'text-slate-700');
      }
    });

    const moreBrandsWrapper = document.getElementById('more-brands-wrapper');
    const toggleBrandsText = document.getElementById('toggle-brands-text');
    const toggleBrandsIcon = document.getElementById('toggle-brands-icon');
    if (isMoreBrandActive && moreBrandsWrapper) {
      moreBrandsWrapper.classList.remove('hidden');
      if (toggleBrandsText) toggleBrandsText.textContent = 'Thu Gọn Thương Hiệu';
      if (toggleBrandsIcon) toggleBrandsIcon.classList.add('rotate-180');
    }

    // Update Active Filter Banner
    const activeFilterBanner = document.getElementById('active-filter-banner');
    const activeFilterLabel = document.getElementById('active-filter-label');
    
    if (activeFilterBanner && activeFilterLabel) {
      if (activeBrand !== 'all') {
        activeFilterBanner.classList.remove('hidden');
        activeFilterBanner.classList.add('flex');
        activeFilterLabel.textContent = `Thương Hiệu ${activeBrand.toUpperCase()}`;
      } else if (activeCategory !== 'all') {
        activeFilterBanner.classList.remove('hidden');
        activeFilterBanner.classList.add('flex');
        const catMap = {
          panel: 'Tấm Pin Mặt Trời',
          inverter: 'Bộ Biến Tần Inverter',
          battery: 'Pin Lưu Trữ Lithium',
          pump: 'Biến Tần Bơm Solar',
          accessories: 'Phụ Kiện Solar'
        };
        activeFilterLabel.textContent = `Danh Mục ${catMap[activeCategory] || activeCategory.toUpperCase()}`;
      } else {
        activeFilterBanner.classList.add('hidden');
        activeFilterBanner.classList.remove('flex');
      }
    }

    renderPagination(totalPages, totalFiltered);

    if (shouldScroll && productsContainer) {
      const yOffset = -120;
      const y = productsContainer.getBoundingClientRect().top + window.pageYOffset + yOffset;
      window.scrollTo({ top: y, behavior: 'smooth' });
    }
  };

  const hasUrlFilter = urlParams.has('brand') || urlParams.has('filter');
  updateGrid(hasUrlFilter);

  const clearFilterBtn = document.getElementById('clear-active-filter-btn');
  if (clearFilterBtn) {
    clearFilterBtn.addEventListener('click', (e) => {
      e.preventDefault();
      activeBrand = 'all';
      activeCategory = 'all';
      searchQuery = '';
      if (searchInput) searchInput.value = '';
      currentPage = 1;
      if (window.history && window.history.replaceState) {
        window.history.replaceState({}, document.title, window.location.pathname);
      }
      updateGrid(false);
    });
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      activeCategory = btn.getAttribute('data-filter');
      activeBrand = 'all';
      currentPage = 1;
      if (window.history && window.history.replaceState) {
        const newUrl = activeCategory === 'all' 
          ? window.location.pathname 
          : `${window.location.pathname}?filter=${encodeURIComponent(activeCategory)}`;
        window.history.replaceState({}, document.title, newUrl);
      }
      updateGrid(true);
    });
  });

  brandBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      activeBrand = btn.getAttribute('data-brand');
      activeCategory = 'all';
      currentPage = 1;
      if (window.history && window.history.replaceState) {
        const newUrl = activeBrand === 'all' 
          ? window.location.pathname 
          : `${window.location.pathname}?brand=${encodeURIComponent(activeBrand)}`;
        window.history.replaceState({}, document.title, newUrl);
      }
      updateGrid(true);
    });
  });

  const toggleBrandsBtn = document.getElementById('toggle-more-brands-btn');
  const moreBrandsWrapper = document.getElementById('more-brands-wrapper');
  const toggleBrandsText = document.getElementById('toggle-brands-text');
  const toggleBrandsIcon = document.getElementById('toggle-brands-icon');

  if (toggleBrandsBtn && moreBrandsWrapper) {
    if (activeBrand !== 'all') {
      moreBrandsWrapper.classList.remove('hidden');
      moreBrandsWrapper.style.display = 'grid';
      if (toggleBrandsText) toggleBrandsText.textContent = 'Thu Gọn Danh Sách';
      if (toggleBrandsIcon) toggleBrandsIcon.classList.add('rotate-180');
    }

    toggleBrandsBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const isHidden = moreBrandsWrapper.classList.contains('hidden') || moreBrandsWrapper.style.display === 'none';
      if (isHidden) {
        moreBrandsWrapper.classList.remove('hidden');
        moreBrandsWrapper.style.display = 'grid';
        if (toggleBrandsText) toggleBrandsText.textContent = 'Thu Gọn Danh Sách';
        if (toggleBrandsIcon) toggleBrandsIcon.classList.add('rotate-180');
      } else {
        moreBrandsWrapper.classList.add('hidden');
        moreBrandsWrapper.style.display = 'none';
        if (toggleBrandsText) toggleBrandsText.textContent = 'Xem Thêm (21 Hãng Khác)';
        if (toggleBrandsIcon) toggleBrandsIcon.classList.remove('rotate-180');
      }
    });
  }

  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      searchQuery = e.target.value.trim().toLowerCase();
      currentPage = 1;
      updateGrid(false);
    });
  }

  if (sortSelect) {
    sortSelect.addEventListener('change', () => {
      currentPage = 1;
      updateGrid(false);
    });
  }
}

// Modal Popups (Product Detail & Inquiries)
function initModals() {
  const modal = document.getElementById('detail-modal');
  const openTriggers = document.querySelectorAll('.open-modal-trigger');
  const closeTriggers = document.querySelectorAll('.close-modal');

  if (!modal) return;

  const modalImg = document.getElementById('modal-img');
  const modalCategory = document.getElementById('modal-category');
  const modalTitle = document.getElementById('modal-title');
  const modalDesc = document.getElementById('modal-desc');

  const openModal = (data) => {
    if (modalImg) modalImg.src = data.img || '';
    if (modalCategory) modalCategory.textContent = data.category || 'Danh Mục';
    if (modalTitle) modalTitle.textContent = data.title || 'Sản Phẩm';
    if (modalDesc) modalDesc.textContent = data.desc || 'Mô tả chi tiết sản phẩm...';

    const modalDetailBtn = document.getElementById('modal-detail-btn');
    if (modalDetailBtn && data.title) {
      modalDetailBtn.href = `chi-tiet-san-pham.html?title=${encodeURIComponent(data.title)}&category=${encodeURIComponent(data.category || '')}&img=${encodeURIComponent(data.img || '')}&desc=${encodeURIComponent(data.desc || '')}`;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
  };

  const closeModal = () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
  };

  openTriggers.forEach(btn => {
    btn.addEventListener('click', () => {
      const data = {
        title: btn.getAttribute('data-title'),
        category: btn.getAttribute('data-category'),
        img: btn.getAttribute('data-img'),
        desc: btn.getAttribute('data-desc')
      };
      openModal(data);
    });
  });

  closeTriggers.forEach(btn => {
    btn.addEventListener('click', closeModal);
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });
}

// Dynamic Product Detail Page Loader
function initProductDetailPage() {
  const isDetailPage = window.location.pathname.includes('chi-tiet-san-pham.html');
  if (!isDetailPage) return;

  const urlParams = new URLSearchParams(window.location.search);
  const title = urlParams.get('title');
  const category = urlParams.get('category');
  const img = urlParams.get('img');
  const desc = urlParams.get('desc');

  if (title) {
    document.title = `${title} - BÁCH ANH GROUP`;
    const titleEl = document.getElementById('detail-title') || document.querySelector('h1');
    if (titleEl) titleEl.textContent = title;

    const breadcrumbTitle = document.getElementById('detail-breadcrumb-title') || document.querySelector('span.truncate');
    if (breadcrumbTitle) breadcrumbTitle.textContent = title;
  }

  if (category) {
    const categoryEl = document.getElementById('detail-category') || document.querySelector('.bg-blue-100.text-blue-700');
    if (categoryEl) categoryEl.textContent = category;
  }

  if (img) {
    const mainImg = document.getElementById('detail-main-img');
    if (mainImg) mainImg.src = img;
  }

  if (desc) {
    const descEl = document.getElementById('detail-desc-text');
    if (descEl) descEl.textContent = desc;
  }
}

// Interactive Forms
function initFormHandlers() {
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
    if (form.getAttribute('onsubmit')) return;
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Cảm ơn bạn! Bách Anh Group đã ghi nhận thông tin và sẽ phản hồi trong 15 phút.');
      form.reset();
    });
  });
}

// Counter Animation for Key Statistics
function initCounterAnim() {
  const counters = document.querySelectorAll('.counter-val');
  if (counters.length === 0) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counter = entry.target;
        const target = parseInt(counter.getAttribute('data-count'), 10) || 0;
        let count = 0;
        const speed = target > 100 ? 15 : 80;

        const updateCount = () => {
          count += Math.ceil(target / 40);
          if (count >= target) {
            counter.textContent = target + '+';
          } else {
            counter.textContent = count + '+';
            setTimeout(updateCount, speed);
          }
        };

        updateCount();
        observer.unobserve(counter);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(c => observer.observe(c));
}

// Global Product Card Click Handler for Product Detail Page
function initProductCardLinks() {
  document.querySelectorAll('.product-item').forEach(item => {
    const titleEl = item.querySelector('h3');
    const imgEl = item.querySelector('img');
    const btnEl = item.querySelector('.open-modal-trigger');

    const title = titleEl ? titleEl.textContent.trim() : (btnEl ? btnEl.getAttribute('data-title') : '');
    const category = btnEl ? btnEl.getAttribute('data-category') : '';
    const img = imgEl ? imgEl.getAttribute('src') : (btnEl ? btnEl.getAttribute('data-img') : '');
    const desc = item.querySelector('p') ? item.querySelector('p').textContent.trim() : (btnEl ? btnEl.getAttribute('data-desc') : '');

    if (titleEl && !titleEl.querySelector('a')) {
      const url = `chi-tiet-san-pham.html?title=${encodeURIComponent(title)}&category=${encodeURIComponent(category)}&img=${encodeURIComponent(img)}&desc=${encodeURIComponent(desc)}`;
      titleEl.innerHTML = `<a href="${url}" class="hover:text-blue-600 transition-colors">${title}</a>`;
    }

    if (imgEl && !imgEl.closest('a')) {
      const url = `chi-tiet-san-pham.html?title=${encodeURIComponent(title)}&category=${encodeURIComponent(category)}&img=${encodeURIComponent(img)}&desc=${encodeURIComponent(desc)}`;
      imgEl.style.cursor = 'pointer';
      imgEl.addEventListener('click', (e) => {
        if (!e.target.closest('button')) {
          window.location.href = url;
        }
      });
    }
  });
}



// Hero Carousel Banner Slider Initialization
function initHeroSlider() {
  const slidesWrapper = document.getElementById('hero-slides-wrapper');
  if (!slidesWrapper) return;

  const slides = slidesWrapper.querySelectorAll('.hero-slide');
  const prevBtn = document.getElementById('hero-prev-btn');
  const nextBtn = document.getElementById('hero-next-btn');
  const dots = document.querySelectorAll('.hero-dot');

  if (slides.length <= 1) return;

  let currentIndex = 0;
  let timer = null;

  const goToSlide = (index) => {
    slides[currentIndex].classList.add('hidden');
    slides[currentIndex].classList.remove('active');
    
    if (dots[currentIndex]) {
      dots[currentIndex].classList.remove('w-8', 'bg-blue-500', 'bg-amber-500', 'bg-emerald-500');
      dots[currentIndex].classList.add('w-2.5', 'bg-slate-700');
    }

    currentIndex = (index + slides.length) % slides.length;

    slides[currentIndex].classList.remove('hidden');
    slides[currentIndex].classList.add('active');

    if (dots[currentIndex]) {
      dots[currentIndex].classList.remove('w-2.5', 'bg-slate-700');
      const activeColors = ['bg-blue-500', 'bg-amber-500', 'bg-emerald-500'];
      dots[currentIndex].classList.add('w-8', activeColors[currentIndex] || 'bg-blue-500');
    }
  };

  const startTimer = () => {
    stopTimer();
    timer = setInterval(() => {
      goToSlide(currentIndex + 1);
    }, 5000);
  };

  const stopTimer = () => {
    if (timer) clearInterval(timer);
  };

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      goToSlide(currentIndex - 1);
      startTimer();
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      goToSlide(currentIndex + 1);
      startTimer();
    });
  }

  dots.forEach((dot, idx) => {
    dot.addEventListener('click', () => {
      goToSlide(idx);
      startTimer();
    });
  });

  const section = document.getElementById('hero-slider-section');
  if (section) {
    section.addEventListener('mouseenter', stopTimer);
    section.addEventListener('mouseleave', startTimer);
  }

  startTimer();
}
