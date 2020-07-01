<div class="content">
    <div class="title">Something went wrong.</div>

    @if(app()->bound('sentry') && app('sentry')->getLastEventId())
        <div class="subtitle">Error ID: {{ app('sentry')->getLastEventId() }}</div>
        <script src="https://browser.sentry-cdn.com/5.18.1/bundle.min.js" integrity="sha384-4zdOhGLDdcXl+MRlpApt/Nvfe6A3AqGGBil9+lwFSkXNTv0rVx0eCyM1EaJCXS7r" crossorigin="anonymous"></script>
        <script>
            Sentry.init({ dsn: 'https://69d4be3107a24d2f84b1abf287122971@o413386.ingest.sentry.io/5299767' });
            Sentry.showReportDialog({ eventId: '{{ app('sentry')->getLastEventId() }}' });
        </script>
    @endif
</div>
