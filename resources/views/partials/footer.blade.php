<style>
:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--text-light:#F8E9A1;--text-dark:#000000;--bg-light:#000000;--bg-gray:#111111;--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2)}.luxury-footer{background-color:var(--bg-gray);border-top:1px solid var(--primary-dark);color:var(--text-light);padding:1.5rem 0;position:relative;overflow:hidden}.luxury-footer::before{content:'';position:absolute;top:0;left:0;width:100%;height:2px;background:linear-gradient(90deg,var(--primary-dark),var(--primary-color),var(--primary-light))}.footer-content{display:flex;flex-direction:column;align-items:center;justify-content:center;max-width:1200px;margin:0 auto;padding:0 1rem}.footer-logo{margin-bottom:1rem}.footer-links,.footer-social{margin-bottom:1.5rem;display:flex}.footer-logo img{height:40px;width:auto}.footer-links{justify-content:center;flex-wrap:wrap;gap:1.5rem}.footer-links a{color:var(--text-light);text-decoration:none;font-size:.9rem;transition:color .3s}.footer-links a:hover,.footer-social a{color:var(--primary-color)}.footer-social{justify-content:center;gap:1rem}.footer-social a{display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background-color:rgba(212,175,55,.1);transition:.3s}.footer-social a:hover{background-color:var(--primary-color);color:var(--text-dark);transform:translateY(-3px)}.footer-copyright{text-align:center;font-size:.9rem;color:var(--text-muted)}.footer-brand{color:var(--primary-color);font-weight:600}@media (max-width:768px){.footer-links{flex-direction:column;align-items:center;gap:.75rem}}
</style>

<footer class="luxury-footer">
    <div class="footer-content">
        <div class="footer-logo">
            <img src="{{ asset('images/dmlogo.png') }}" alt="Domoteknic Logo">
        </div>
        
        <div class="footer-links">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('produits.index') }}">Produits</a>
            <a href="{{ route('contact') }}">Contact</a>
           
            
        </div>
        
        
        
        <div class="footer-copyright">
            &copy; {{ date('Y') }} Copyright:
            <span class="footer-brand">parfums</span>
        </div>
    </div>
</footer>