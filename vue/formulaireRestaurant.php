<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un Restaurant</title>
    <link rel="stylesheet" href="../css/restau.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Restaurant</h1>
        <form id="restaurantForm" action="add_restaurant.php" method="post" enctype="multipart/form-data">
            <!-- Étape 1 -->
            <div class="form-step form-step-active">
                <div class="step-header">Étape 1 sur 3</div>
                <fieldset>
                    <legend>Informations du Restaurant</legend>
                    <label for="nom">Nom du restaurant:</label>
                    <input type="text" id="nom" name="nom" required><br><br>
                    
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="adresse" name="adresse" required><br><br>
                    
                    <label for="restaurateur">Nom du restaurateur:</label>
                    <input type="text" id="restaurateur" name="restaurateur" required><br><br>
                    
                    <label for="description">Description de l'établissement:</label>
                    <textarea id="description" name="description"></textarea><br><br>
                    
                    <label for="images">Images:</label>
                    <input type="file" id="images" name="images[]" multiple><br><br>
                </fieldset>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
            
                <!-- Étape 2 -->
    <div class="form-step">
        <div class="step-header">Étape 2 sur 3</div>
        <fieldset>
            <legend>Carte des Plats</legend>
            <div id="carte">
                <div class="plat">
                    <label for="plat-nom-1">Nom du plat:</label>
                    <input type="text" id="plat-nom-1" name="plats[0][nom]" required><br><br>
                    
                    <label for="plat-categorie-1">Catégorie:</label>
                    <select id="plat-categorie-1" name="plats[0][categorie]" required>
                        <option value="entrée">Entrée</option>
                        <option value="plat">Plat</option>
                        <option value="dessert">Dessert</option>
                        <option value="fromage">Fromage</option>
                    </select><br><br>
                    
                    <label for="plat-prix-1">Prix:</label>
                    <input type="text" id="plat-prix-1" name="plats[0][prix]" required>
                    <select id="plat-devise-1" name="plats[0][devise]" required>
                        <option value="EUR">EUR</option>
                        <option value="USD">USD</option>
                        <option value="XOF">XOF</option>
                        <!-- Ajoutez d'autres devises au besoin -->
                    </select><br><br>
                    
                    <label for="plat-description-1">Description:</label>
                    <textarea id="plat-description-1" name="plats[0][description]"></textarea><br><br>
                </div>
            </div>
            <button type="button" onclick="addPlat()">Ajouter un autre plat</button><br><br>
        </fieldset>
        <button type="button" onclick="prevStep()">Précédent</button>
        <button type="button" onclick="nextStep()">Suivant</button>
    </div>

            
            <!-- Étape 3 -->
            <div class="form-step">
                <div class="step-header">Étape 3 sur 3</div>
                <fieldset>
                    <legend>Menus</legend>
                    <div id="menus">
                        <div class="menu">
                            <label for="menu-titre-1">Titre du menu:</label>
                            <input type="text" id="menu-titre-1" name="menus[0][titre]" required><br><br>
                            
                            <label for="menu-description-1">Description:</label>
                            <textarea id="menu-description-1" name="menus[0][description]"></textarea><br><br>
                            
                            <label for="menu-prix-1">Prix:</label>
                            <input type="text" id="menu-prix-1" name="menus[0][prix]" required><br><br>
                            
                            <label for="menu-elements-1">Éléments du menu (séparés par des virgules):</label>
                            <input type="text" id="menu-elements-1" name="menus[0][elements]"><br><br>
                        </div>
                    </div>
                    <button type="button" onclick="addMenu()">Ajouter un autre menu</button><br><br>
                </fieldset>
                <button type="button" onclick="prevStep()">Précédent</button>
                <input type="submit" value="Ajouter le restaurant">
            </div>
        </form>
    </div>

    <script>
        let currentStep = 0;
        let platCount = 1;
        let menuCount = 1;

        function showStep(step) {
            const steps = document.querySelectorAll('.form-step');
            steps.forEach((stepElement, index) => {
                if (index === step) {
                    stepElement.classList.add('form-step-active');
                } else {
                    stepElement.classList.remove('form-step-active');
                }
            });
        }

        function nextStep() {
            currentStep++;
            showStep(currentStep);
        }

        function prevStep() {
            currentStep--;
            showStep(currentStep);
        }

        function addPlat() {
            platCount++;
            const platDiv = document.createElement('div');
            platDiv.className = 'plat';
            platDiv.innerHTML = `
                <label for="plat-nom-${platCount}">Nom du plat:</label>
                <input type="text" id="plat-nom-${platCount}" name="plats[${platCount - 1}][nom]" required><br><br>
                
                <label for="plat-categorie-${platCount}">Catégorie:</label>
                <select id="plat-categorie-${platCount}" name="plats[${platCount - 1}][categorie]" required>
                    <option value="entrée">Entrée</option>
                    <option value="plat">Plat</option>
                    <option value="dessert">Dessert</option>
                    <option value="fromage">Fromage</option>
                </select><br><br>
                
                <label for="plat-prix-${platCount}">Prix:</label>
                <input type="text" id="plat-prix-${platCount}" name="plats[${platCount - 1}][prix]" required><br><br>
                
                <label for="plat-description-${platCount}">Description:</label>
                <textarea id="plat-description-${platCount}" name="plats[${platCount - 1}][description]"></textarea><br><br>
            `;
            document.getElementById('carte').appendChild(platDiv);
        }

        function addMenu() {
            menuCount++;
            const menuDiv = document.createElement('div');
            menuDiv.className = 'menu';
            menuDiv.innerHTML = `
                <label for="menu-titre-${menuCount}">Titre du menu:</label>
                <input type="text" id="menu-titre-${menuCount}" name="menus[${menuCount - 1}][titre]" required><br><br>
                
                <label for="menu-description-${menuCount}">Description:</label>
                <textarea id="menu-description-${menuCount}" name="menus[${menuCount - 1}][description]"></textarea><br><br>
                
                <label for="menu-prix-${menuCount}">Prix:</label>
                <input type="text" id="menu-prix-${menuCount}" name="menus[${menuCount - 1}][prix]" required><br><br>
                
                <label for="menu-elements-${menuCount}">Éléments du menu (séparés par des virgules):</label>
                <input type="text" id="menu-elements-${menuCount}" name="menus[${menuCount - 1}][elements]"><br><br>
            `;
            document.getElementById('menus').appendChild(menuDiv);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });
    </script>
</body>
</html>
