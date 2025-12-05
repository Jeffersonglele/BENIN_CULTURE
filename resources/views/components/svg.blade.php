<svg width="100%" height="100%" viewBox="0 0 400 700" preserveAspectRatio="xMidYMid meet" 
     xmlns="http://www.w3.org/2000/svg" class="benin-map">
    <!-- Alibori -->
    <path d="M200,50 L220,70 L215,120 L210,150 L180,160 L170,140 L160,120 L180,80 Z" 
          class="region" data-region="alibori" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Atacora -->
    <path d="M150,100 L180,110 L190,140 L180,160 L150,170 L130,150 L140,120 Z" 
          class="region" data-region="atacora" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Borgou -->
    <path d="M220,70 L250,80 L260,100 L270,130 L260,160 L240,170 L210,150 L215,120 Z" 
          class="region" data-region="borgou" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Collines -->
    <path d="M200,180 L230,190 L240,220 L220,240 L190,230 L180,200 Z" 
          class="region" data-region="collines" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Zou -->
    <path d="M180,200 L190,230 L170,250 L150,240 L160,210 Z" 
          class="region" data-region="zou" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Plateau -->
    <path d="M220,240 L240,220 L250,250 L230,270 Z" 
          class="region" data-region="plateau" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Ouémé -->
    <path d="M230,270 L250,250 L260,280 L240,300 Z" 
          class="region" data-region="oueme" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Atlantique -->
    <path d="M240,300 L260,280 L270,310 L250,320 Z" 
          class="region" data-region="atlantique" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Littoral -->
    <path d="M250,320 L270,310 L280,330 L260,340 Z" 
          class="region" data-region="littoral" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Mono -->
    <path d="M200,320 L220,310 L230,330 L210,350 Z" 
          class="region" data-region="mono" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Couffo -->
    <path d="M180,300 L200,310 L190,330 L170,320 Z" 
          class="region" data-region="couffo" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Donga -->
    <path d="M150,170 L180,180 L170,210 L160,240 L140,220 L130,180 Z" 
          class="region" data-region="donga" fill="#f0f0f0" stroke="#666" stroke-width="1" />
    
    <!-- Region labels -->
    <text x="200" y="90" class="region-label" data-region="alibori">Alibori</text>
    <text x="150" y="140" class="region-label" data-region="atacora">Atacora</text>
    <text x="240" y="120" class="region-label" data-region="borgou">Borgou</text>
    <text x="200" y="220" class="region-label" data-region="collines">Collines</text>
    <text x="170" y="230" class="region-label" data-region="zou">Zou</text>
    <text x="230" y="260" class="region-label" data-region="plateau">Plateau</text>
    <text x="240" y="290" class="region-label" data-region="oueme">Ouémé</text>
    <text x="250" y="315" class="region-label" data-region="atlantique">Atlantique</text>
    <text x="260" y="340" class="region-label" data-region="littoral">Littoral</text>
    <text x="210" y="340" class="region-label" data-region="mono">Mono</text>
    <text x="180" y="320" class="region-label" data-region="couffo">Couffo</text>
    <text x="150" y="200" class="region-label" data-region="donga">Donga</text>
    
    <style>
        .region {
            transition: fill 0.3s, stroke 0.3s;
            cursor: pointer;
        }
        .region:hover {
            fill: #ffd700;
            stroke: #333;
        }
        .region.highlight {
            fill: #ffd700;
            stroke: #333;
            stroke-width: 2px;
        }
        .region-label {
            font-size: 10px;
            font-family: Arial, sans-serif;
            pointer-events: none;
            text-anchor: middle;
            fill: #333;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const regions = document.querySelectorAll('.region');
            
            regions.forEach(region => {
                region.addEventListener('mouseenter', function() {
                    const regionId = this.getAttribute('data-region');
                    document.querySelectorAll(`[data-region="${regionId}"]`).forEach(el => {
                        el.classList.add('highlight');
                    });
                });
                
                region.addEventListener('mouseleave', function() {
                    const regionId = this.getAttribute('data-region');
                    document.querySelectorAll(`[data-region="${regionId}"]`).forEach(el => {
                        el.classList.remove('highlight');
                    });
                });
                
                region.addEventListener('click', function() {
                    const regionName = this.getAttribute('data-region');
                    alert(`Selected region: ${regionName}`);
                    // You can add more interactive features here
                });
            });
        });
    </script>
</svg>