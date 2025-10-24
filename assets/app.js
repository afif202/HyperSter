document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      if(id.length > 1 && document.querySelector(id)){
        e.preventDefault();
        document.querySelector(id).scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('reveal');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.card, .milestone').forEach(el => observer.observe(el));
});

$(function(){
  $('.faq-q').on('click', function(){
    $(this).next('.faq-a').slideToggle(180);
    $(this).find('.chev').toggleClass('open');
  });

  window.toast = (text) => {
    const t = $('<div/>').text(text).addClass('toast')
      .css({
        position:'fixed', bottom:'20px', left:'50%', transform:'translateX(-50%)',
        padding:'10px 14px', border:'1px solid rgba(255,255,255,.2)',
        background:'rgba(12,14,20,.9)', color:'#e6e6f0', borderRadius:'12px', zIndex:9999
      }).hide().appendTo('body').fadeIn(150);
    setTimeout(()=> t.fadeOut(200, ()=> t.remove()), 1600);
  }

  $('#copy-tagline').on('click', function(){
    navigator.clipboard.writeText('HyperSter Protocol — Permissionless Launch & Liquidity Engine');
    toast('Tagline disalin ✅');
  });
});