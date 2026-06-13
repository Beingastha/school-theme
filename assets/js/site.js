/* Excellence School Bhopal — site interactions + animation layer */
(function () {
  "use strict";

  document.documentElement.classList.add("page-loaded");

  /* =========================================================
     Scroll progress bar
  ========================================================= */
  var progressBar = document.createElement("div");
  progressBar.className = "scroll-progress";
  document.body.appendChild(progressBar);

  function updateProgress() {
    var doc = document.documentElement;
    var scrollTop = window.scrollY;
    var maxScroll  = doc.scrollHeight - doc.clientHeight;
    var pct = maxScroll > 0 ? (scrollTop / maxScroll) * 100 : 0;
    progressBar.style.width = pct.toFixed(1) + "%";
  }

  /* =========================================================
     Sticky header shadow
  ========================================================= */
  var header = document.querySelector(".siteheader");
  function onScroll() {
    if (header) header.classList.toggle("scrolled", window.scrollY > 8);
    updateProgress();
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  /* =========================================================
     Mobile drawer
  ========================================================= */
  var drawer  = document.querySelector(".drawer");
  var openBtn = document.querySelector(".hamburger");
  var closeBtn = document.querySelector(".drawer-close");
  function openDrawer()  { if (drawer) { drawer.classList.add("open");    document.body.style.overflow = "hidden"; } }
  function closeDrawer() { if (drawer) { drawer.classList.remove("open"); document.body.style.overflow = "";       } }
  if (openBtn)  openBtn.addEventListener("click", openDrawer);
  if (closeBtn) closeBtn.addEventListener("click", closeDrawer);
  if (drawer) {
    drawer.addEventListener("click", function (e) {
      if (e.target.classList.contains("drawer-scrim") || e.target.tagName === "A") closeDrawer();
    });
  }

  /* =========================================================
     Drawer dropdown accordions (About / Academics / Student Corner)
  ========================================================= */
  document.querySelectorAll(".drawer-nav .nav-item.has-children > .nav-link").forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      var item = link.closest(".nav-item");
      if (item) item.classList.toggle("open");
    });
  });

  /* =========================================================
     Language toggle (EN / HI)
  ========================================================= */
  var LANG_KEY = "esb-lang";
  function applyLang(lang) {
    document.documentElement.setAttribute("data-lang", lang);
    document.querySelectorAll("[data-en]").forEach(function (el) {
      var val = lang === "hi" ? el.getAttribute("data-hi") : el.getAttribute("data-en");
      if (val !== null && val !== undefined) el.textContent = val;
    });
    document.querySelectorAll(".lang-toggle").forEach(function (tg) {
      tg.querySelectorAll("button").forEach(function (b) {
        b.classList.toggle("active", b.getAttribute("data-lang") === lang);
      });
    });
    try { localStorage.setItem(LANG_KEY, lang); } catch (e) {}
  }
  document.querySelectorAll(".lang-toggle button").forEach(function (b) {
    b.addEventListener("click", function () { applyLang(b.getAttribute("data-lang")); });
  });
  var savedLang = "en";
  try { savedLang = localStorage.getItem(LANG_KEY) || "en"; } catch (e) {}
  applyLang(savedLang);

  /* =========================================================
     Count-up stats
  ========================================================= */
  function animateCount(el) {
    var target = parseFloat(el.getAttribute("data-count"));
    var dec    = (el.getAttribute("data-count").indexOf(".") > -1) ? 1 : 0;
    var dur    = 1500, start = null;
    var parent = el.parentElement;
    function step(ts) {
      if (!start) start = ts;
      var p     = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = (target * eased).toFixed(dec);
      if (p < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target.toFixed(dec);
        /* small pop when counter finishes */
        if (parent) {
          parent.classList.add("stat-popped");
          parent.addEventListener("animationend", function () {
            parent.classList.remove("stat-popped");
          }, { once: true });
        }
      }
    }
    requestAnimationFrame(step);
  }

  /* =========================================================
     Section-head: register eyebrow / h2 / p as reveal targets
     so each child fades in with staggered delay (set in CSS).
  ========================================================= */
  document.querySelectorAll(".section-head").forEach(function (head) {
    head.querySelectorAll(".eyebrow, h2, p").forEach(function (child) {
      if (!child.classList.contains("reveal")) {
        child.classList.add("reveal");
      }
    });
  });

  /* =========================================================
     Stagger grid: set inline transition-delay on each child
     for grids that have the .stagger-grid class.
  ========================================================= */
  document.querySelectorAll(".stagger-grid").forEach(function (grid) {
    var items = grid.querySelectorAll(".reveal, .card, .fac-card, .ach-card, .why-card, .step-card, .date-card, .value");
    items.forEach(function (item, i) {
      item.style.transitionDelay = (i * 90) + "ms";
    });
  });

  /* =========================================================
     IntersectionObserver — reveals + count-up
  ========================================================= */
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (!en.isIntersecting) return;
      en.target.classList.add("in");

      /* trigger count-up for any [data-count] inside */
      en.target.querySelectorAll("[data-count]").forEach(function (c) {
        if (!c.dataset.done) { c.dataset.done = "1"; animateCount(c); }
      });
      if (en.target.hasAttribute("data-count") && !en.target.dataset.done) {
        en.target.dataset.done = "1"; animateCount(en.target);
      }

      io.unobserve(en.target);
    });
  }, { threshold: 0.15, rootMargin: "0px 0px -6% 0px" });

  document.querySelectorAll(".reveal, .reveal-left, .reveal-right, [data-count]").forEach(function (el) {
    io.observe(el);
  });

  /* =========================================================
     Typewriter / text cycler
     Usage: <span class="type-cycle" data-words="Word1|Word2|Word3">Word1</span>
     A blinking cursor span is injected right after the element.
  ========================================================= */
  document.querySelectorAll(".type-cycle").forEach(function (el) {
    var words = (el.getAttribute("data-words") || "")
      .split("|").map(function (w) { return w.trim(); }).filter(Boolean);
    if (words.length < 2) return;

    /* inject cursor */
    var cursor = document.createElement("span");
    cursor.className = "type-cursor";
    cursor.setAttribute("aria-hidden", "true");
    el.insertAdjacentElement("afterend", cursor);

    var idx        = 0;          /* current word index */
    var charPos    = words[0].length; /* start at end of first word */
    var isDeleting = false;
    var pausing    = false;

    /* typing speeds (ms) */
    var SPEED_TYPE   = 58;
    var SPEED_DELETE = 34;
    var PAUSE_AFTER  = 1700;
    var PAUSE_BEFORE = 240;

    function tick() {
      if (pausing) return; /* wait-out handled by setTimeout */

      var word = words[idx];

      if (!isDeleting) {
        /* typing forward */
        charPos++;
        el.textContent = word.substring(0, charPos);
        if (charPos === word.length) {
          /* pause at full word, then start deleting */
          pausing = true;
          setTimeout(function () {
            pausing    = false;
            isDeleting = true;
            setTimeout(tick, SPEED_DELETE);
          }, PAUSE_AFTER);
          return;
        }
        setTimeout(tick, SPEED_TYPE);
      } else {
        /* deleting backwards */
        charPos--;
        el.textContent = word.substring(0, charPos);
        if (charPos === 0) {
          /* advance to next word, brief pause */
          isDeleting = false;
          idx        = (idx + 1) % words.length;
          pausing    = true;
          setTimeout(function () {
            pausing = false;
            setTimeout(tick, SPEED_TYPE);
          }, PAUSE_BEFORE);
          return;
        }
        setTimeout(tick, SPEED_DELETE);
      }
    }

    /* start cycling after 1.8 s (let page settle + hero entrance finish) */
    setTimeout(function () {
      isDeleting = true; /* begin by deleting the initial word */
      setTimeout(tick, SPEED_DELETE + 200);
    }, 1800);
  });

  /* =========================================================
     Hero: ensure all .hero-enter elements are visible
     even if animations are somehow blocked (fallback).
  ========================================================= */
  function forceHeroVisibility() {
    document.querySelectorAll(".hero-enter, .hero-enter-right, .hero-enter-scale").forEach(function (el) {
      el.style.opacity   = "1";
      el.style.transform = "none";
    });
  }
  if (document.readyState === "complete") {
    setTimeout(forceHeroVisibility, 3000);
  } else {
    window.addEventListener("load", function () {
      setTimeout(forceHeroVisibility, 3000);
    });
  }

})();
