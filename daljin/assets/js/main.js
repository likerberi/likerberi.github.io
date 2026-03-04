// 김달진미술연구소 리뉴얼 기획서 공통 JS
(function () {
  'use strict';

  // 현재 페이지 네비게이션 활성화
  function setActiveNav() {
    const path = location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav-item a').forEach(function (a) {
      const href = a.getAttribute('href').split('/').pop();
      if (href === path) {
        a.classList.add('active');
      }
    });
  }

  // 모바일 사이드바 토글
  function initMobileMenu() {
    const btn = document.querySelector('.menu-btn');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.createElement('div');
    overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:90;display:none;';
    document.body.appendChild(overlay);

    if (btn && sidebar) {
      btn.addEventListener('click', function () {
        sidebar.classList.toggle('open');
        overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
      });
      overlay.addEventListener('click', function () {
        sidebar.classList.remove('open');
        overlay.style.display = 'none';
      });
    }
  }

  // 프로그레스 바 애니메이션
  function animateProgressBars() {
    const bars = document.querySelectorAll('.progress-fill[data-width]');
    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          const bar = entry.target;
          bar.style.width = bar.dataset.width;
          observer.unobserve(bar);
        }
      });
    }, { threshold: 0.2 });
    bars.forEach(function (b) {
      b.style.width = '0%';
      observer.observe(b);
    });
  }

  // 카운트업 애니메이션
  function animateCountUp() {
    const nums = document.querySelectorAll('.stat-number[data-target]');
    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = parseInt(el.dataset.target, 10);
          const suffix = el.dataset.suffix || '';
          const duration = 1200;
          const step = 16;
          const totalSteps = duration / step;
          let current = 0;
          const inc = target / totalSteps;
          const timer = setInterval(function () {
            current = Math.min(current + inc, target);
            el.textContent = Math.round(current).toLocaleString() + suffix;
            if (current >= target) clearInterval(timer);
          }, step);
          observer.unobserve(el);
        }
      });
    }, { threshold: 0.3 });
    nums.forEach(function (n) { observer.observe(n); });
  }

  // 현재 날짜 표시
  function setCurrentDate() {
    const el = document.getElementById('current-date');
    if (el) {
      const d = new Date(2026, 2, 4); // 2026-03-04
      el.textContent = d.toLocaleDateString('ko-KR', { year: 'numeric', month: 'long', day: 'numeric' });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    setActiveNav();
    initMobileMenu();
    animateProgressBars();
    animateCountUp();
    setCurrentDate();
  });
})();
