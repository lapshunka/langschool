<footer class="site-footer" style="background-color: #2d3748; color: #a0aec0; text-align: center; padding: 15px 0; margin-top: auto;">
    <div class="container">
        <p>&copy; {{ date('Y') }} Языковая школа. Все права защищены.</p>
        <p style="font-size: 0.85em; color: #63b3ed; margin-top: 5px;">⚡ Запросов к БД: {{ count(DB::getQueryLog()) }}</p>
    </div>
</footer>