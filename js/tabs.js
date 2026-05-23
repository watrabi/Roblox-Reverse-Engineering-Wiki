(function() {
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.tab-btn');
        if (!btn) return;
        var container = btn.closest('.tab-container');
        if (!container) return;
        var tabId = btn.getAttribute('data-tab');
        container.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
        container.querySelectorAll('.tab-panel').forEach(function(p) { p.classList.remove('active'); });
        btn.classList.add('active');
        var panel = container.querySelector('.tab-panel[data-tab="' + tabId + '"]');
        if (panel) panel.classList.add('active');
    });
})();
