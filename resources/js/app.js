import './bootstrap.js';
import './echo.js';

// Points d'entrée spécifiques à certaines pages (dashboard, carte)
// sont chargés conditionnellement via les balises <script type="module"> des vues,
// qui importent directement window.Echo déjà initialisé ci-dessus.
