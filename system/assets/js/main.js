(function() {
  let hasLoaded = false;
  const elements = [];
  // a function for highlighting the syntax of elements located in elements by means of methods highlight.js
  const highlight = () => {
    const items = elements.slice();
    elements.length = 0;
    items.forEach(item => {
      let lang = false;
      item.classList.forEach(className => {
        if (className.indexOf('lang-') === 0) {
          lang = className.replace('lang-', '');
        }
      })
      const result = lang ? hljs.highlight(item.textContent, { language: lang }) : hljs.highlightAuto(item.textContent);
      item.innerHTML = result.value;
    });
  }

  const loadCSSandJS = () => {
    // inserting styles
    const style = document.createElement('link');
    style.rel = 'stylesheet';
    // inserting the script
    const script = document.createElement('script');
    script.src = 'system/assets/js/highlight.min.js';
    script.async = 1;
    document.head.appendChild(script);
    script.onload = () => {
      // after loading the script, we assign the hasLoaded variable the value true and call the highlight function to highlight the syntax
      hasLoaded = true;
      highlight();
    }
  }

  const cb = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = entry.target;
        elements.push(target);
        observer.unobserve(target);
      }
    });
    if (elements.length) {
      if (hasLoaded) {
        highlight();
      } else {
        loadCSSandJS();
      }
    }
  }
  const params = {
    root: null,
    rootMargin: '0px 0px 200px 0px'
  }
  // creating an observer
  const observer = new IntersectionObserver(cb, params);
  document.querySelectorAll('pre>code').forEach(item => {
    observer.observe(item);
  });
})();
