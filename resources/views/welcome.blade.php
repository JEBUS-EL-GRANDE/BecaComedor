<!--http://localhost:8000/register-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comedor U.A.G.R.M</title>
    <link rel="stylesheet" href="#">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    background: #fdfdfd;
    overflow-x: hidden;
}
/* Navigation */
nav {
    position: fixed;
    top: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(6px);
    z-index: 1000;
    padding: 1rem 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.diasSemanas {
    color: #e74c3c;
    font-weight: bold;
    font-size: 18px;
}
.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
}
.logo {
    font-size: 2rem;
    font-weight: bold;
    color: #e74c3c;
    text-decoration: none;
    transition: color 0.3s ease;
}
.logo:hover {
    color: #333;
}
/*.bordeDiv {
    border-right: 1px solid #d8babaff;
    padding-right: 1rem;        
    margin-right: 1rem;    
    border-right: 2px solid #724540ff;
    padding-right: 1rem;
    margin-right: 1rem;   
}*/

.nav-links {
    display: flex;
    list-style: none;
    gap: 1.5rem;
}
.nav-links a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 6px;
    transition: all 0.3s ease;
}
.nav-links a:hover,
.nav-links a.active {
    color: #fff;
    background: #e74c3c;
}
/* Hero Section */
.hero {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e8f8ff, #fefefe);
}
.hero-content {
    text-align: center;
    z-index: 2;
    max-width: 800px;
    padding: 0 2rem;
    margin-top: 100px;
}
.hero h1 {
    font-size: 3.5rem;
    margin-bottom: 1rem;
    color: #222;
}
.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #555;
    position: relative;
    min-height: 2em;
    display: flex;
    justify-content: center;
    align-items: center;
}
.text-option {
    position: absolute;
    width: 100%;
    text-align: center;
    left: 0;
    right: 0;
    opacity: 0;
    animation: textCycle 12s ease-in-out infinite;
    white-space: normal;
    padding: 0 20px;
}
.text-option:nth-child(1) { animation-delay: 0s; }
.text-option:nth-child(2) { animation-delay: 4s; }

@keyframes textCycle {
    0%, 100% { opacity: 0; transform: translateY(20px) scale(0.95); }
    8%, 25% { opacity: 1; transform: translateY(0) scale(1); }
    33% { opacity: 0; transform: translateY(-20px) scale(0.95); }
}
/* Section Styles */
section {
    padding: 5rem 2rem;
    max-width: 1200px;
    margin: 0 auto;
}
h2 {
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 3rem;
    color: #333;
    position: relative;
}
h2::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: #e74c3c;
    border-radius: 2px;
}
/* Menu Section */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}
.menu-item {
    background: #ffffff;
    padding: 2rem;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.menu-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}
.menu-item-image {
    width: 100%;
    height: 200px;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    object-fit: cover;
}
.menu-item h3 {
    color: #e74c3c;
    margin-bottom: 1rem;
    font-size: 1.6rem;
}
.menu-item p {
    color: #555;
    margin-bottom: 1rem;
}
/* Footer */
footer {
    background: #222;
    color: white;
    text-align: center;
    padding: 3rem 2rem;
}
.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}
.footer-section h3 {
    margin-bottom: 1rem;
    color: #e74c3c;
}
.footer-section p,
.footer-section a {
    color: #ccc;
    text-decoration: none;
    line-height: 1.8;
    transition: color 0.3s ease;
}
.footer-section a:hover {
    color: #fff;
}
/* Mobile Responsive */
@media (max-width: 768px) {
    .hero h1 { font-size: 2.5rem; }
    .hero p { font-size: 1rem; }
    h2 { font-size: 2rem; }
    section { padding: 3rem 1rem; }
    .menu-grid { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .hero h1 { font-size: 2rem; }
}

    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="#home" class="logo">
                <span>Comedor</span>
            </a>
            <ul class="nav-links">
                <a class="bordeDiv" href="{{ route('login') }}">cerrar sesion</a>
                {{-- O si no funciona: --}}
                <li><a href="{{ url('/asistencia-publica') }}">Asistencia</a></li>
                
                {{-- Horario Personal de Cocina: Usa un login simple para CI --}}
                <li><a href="{{ route('cocina.horario.showLoginForm') }}">Horario Personal de cocina</a></li>
                
                {{-- Login Encargado: Ya implementado --}}
                <li><a href="{{ route('encargado.login') }}">Login Encargado</a></li>
                
                {{-- Login ADMIN: Ya implementado --}}
                <li><a href="{{ route('admin.login') }}">Login ADMIN</a></li> 
            </ul>
        </div>
    </nav>
    <section id="home" class="hero">
        <div class="diagonal-grid"></div>
        <div class="static-decoration"></div>
        <div class="bottom-right-decoration"></div>
        <div class="hero-content">
            <h1>Bienvenido a comedor universitario U.A.G.R.M </h1>
            <p>
                <span class="text-option">Almuerzos y Cenas</span>
                <span class="text-option">lo mejorers platillos de la U</span>
            </p>
            <p>Atencion del servicio<br>
                Almuezo: <br>
                    Lunes - Sabado: 11:00 AM - 13:00 PM<br>
                Cena: <br>
                    Lunes - Viernes: 17:00 PM - 18:00 PM<br>
            </p>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu">
    <h2>Menu de esta semana</h2>
    <div class="menu-grid">
        <div class="menu-item">
            <img src="{{ asset('images/guiso.png') }}" alt="guiso" class="menu-item-image">
            <div class="menu-item-content">
                <h3>Guiso</h3>
                <p class="diasSemanas">Lunes</p>
                <p>arroz, papa, carne de res, y <br>variado de verduras</p>
            </div>
        </div>
        <div class="menu-item">
            <img src="{{ asset('images/sopa.jpg') }}" alt="caldo de pollo" class="menu-item-image">
            <div class="menu-item-content">
                <h3>Caldo de pollo</h3>
                <p class="diasSemanas">Martes</p>
                <p>Vegetales,fideos, carne de pollo y diferentes sazones<br> para mas sabor</p>
            </div>
        </div>
        <div class="menu-item">
            <img src="{{ asset('images/unSimple.jpg') }}" alt="tortilla y verduras" class="menu-item-image">
            <div class="menu-item-content">
                <h3>Comida THAI</h3>
                <p class="diasSemanas">Miércoles</p>
                <p>tortilla, con acompañamiento de verduras y una sopita</p>
            </div>
        </div>
        <div class="menu-item">
            <img src="{{ asset('images/milanesa.png') }}" alt="milanesas" class="menu-item-image">
            <div class="menu-item-content">
                <h3>Milanesa</h3>
                <p class="diasSemanas">Jueves</p>
                <p>Milanesa de pollo, arroz y verduras</p>
            </div>
        </div>
        <div class="menu-item">
            <img src="{{ asset('images/arrozGandules.png') }}" alt="arrozGandules" class="menu-item-image">
            <div class="menu-item-content">
                <h3>Arroz Gandules</h3>
                <p class="diasSemanas">Viernes</p>
                <p>Arroz amarillo algo de carne bastante sazón y cebolla, arvejas, pimientos</p>
            </div>
        </div>
        <div class="menu-item">
            <img src="{{ asset('images/fideos-con-verduras.png') }}" alt="fideos con verduras" class="menu-item-image">
            <div class="menu-item-content">
                <h3>Fideos con verduras</h3>
                <p class="diasSemanas">Sábado</p>
                <p>fideos con guiso de verduras variado</p>
            </div>
        </div>
    </div>
</section>

    

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contactanos</h3>
                <p>Phone: 591 2356195<br>
                Email: juancordero@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>Horas de servicio</h3>
                <p>Almuezo: <br>
                    Lunes - Sabado: 11:00 AM - 13:00 PM<br>
                Cena: <br>
                Lunes - Viernes: 17:00 PM - 18:00 PM<br>
                </p>
            </div>
            <div class="footer-section">
                <h3>Mantente al tanto en</h3>
                <p><a href="#">Facebook</a><br>
                <a href="#">Instagram</a><br>
                <a href="#">Twitter</a><br>
                <a href="#">LinkedIn</a></p>
            </div>
        </div>
    </footer>
</body>
</html>