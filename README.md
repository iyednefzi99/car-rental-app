# **Projet Laravel : Application de Réservation de Voitures en Ligne**  

## **1. Introduction**  
Ce document décrit en détail une application web développée avec **Laravel** permettant la gestion et la réservation de voitures en ligne.  

**Fonctionnalités principales :**  
✅ Gestion CRUD des voitures  
✅ Réservation avec vérification des disponibilités  
✅ Calcul automatique du prix total  
✅ Interface d'administration  

---

## **2. Structure du Projet**  

### **2.1. Modèles (Eloquent)**  
| Modèle       | Relations | Méthodes principales |  
|--------------|-----------|----------------------|  
| `Car`        | `hasMany(Reservation)` | `estDisponible()` |  
| `Reservation`| `belongsTo(Car)` | `getNombreJoursAttribute()` |  

### **2.2. Contrôleurs**  
| Contrôleur | Rôle |  
|------------|------|  
| `CarController` | Gestion CRUD des voitures |  
| `ReservationController` | Traitement des réservations |  
| `AdminController` | Interface d'administration |  

### **2.3. Routes**  
```php
// Public
Route::get('/', [CarController::class, 'index']);
Route::resource('cars', CarController::class)->only(['index', 'show']);
Route::resource('reservations', ReservationController::class)->only(['create', 'store']);

// Admin
Route::prefix('admin')->group(function () {
    Route::resource('cars', CarController::class)->except(['index', 'show']);
    Route::get('reservations', [AdminController::class, 'reservations']);
});
```

---

## **3. Fonctionnalités Détailées**  

### **3.1. Gestion des Voitures (CRUD)**  
- **Ajout** : Formulaire avec upload d'image  
- **Modification** : Mise à jour des informations  
- **Suppression** : Avec confirmation  

### **3.2. Réservation**  
- Vérification des **dates disponibles**  
- Calcul du **prix total** en fonction du nombre de jours  
- Envoi d'un **email de confirmation** (optionnel)  

### **3.3. Interface Admin**  
- Liste des **réservations**  
- Filtrage par **voiture** ou **date**  

---

## **4. Base de Données**  

### **4.1. Schéma des Tables**  
| Table | Colonnes |  
|-------|---------|  
| `cars` | `id, marque, modèle, immatriculation, prix_par_jour, image, disponible` |  
| `reservations` | `id, nom_client, email_client, voiture_id, date_debut, date_fin, prix_total` |  

### **4.2. Exemple de Données**  
```sql
INSERT INTO cars (marque, modèle, immatriculation, prix_par_jour) 
VALUES ('Peugeot', '208', 'AB-123-CD', 50.00);
```

---

## **5. Captures d'Écran (Exemples)**  

### **5.1. Page d'Accueil**  
![Liste des voitures disponibles](https://via.placeholder.com/600x400?text=Liste+des+voitures)  

### **5.2. Formulaire de Réservation**  
![Formulaire de réservation](https://via.placeholder.com/600x400?text=Formulaire+de+réservation)  

### **5.3. Interface Admin**  
![Tableau de bord admin](https://via.placeholder.com/600x400?text=Interface+Admin)  

---

## **6. Déploiement**  

### **6.1. Prérequis**  
- PHP 8.0+  
- MySQL 5.7+  
- Composer  

### **6.2. Étapes**  
1. Cloner le dépôt :  
   ```bash
   git clone https://github.com/votre-utilisateur/car-rental-app.git
   ```
2. Installer les dépendances :  
   ```bash
   composer install
   npm install
   ```
3. Configurer `.env` et lancer les migrations :  
   ```bash
   php artisan migrate --seed
   ```
4. Démarrer le serveur :  
   ```bash
   php artisan serve
   ```

---

## **7. Conclusion**  
Cette application démontre une implémentation complète de **Laravel** avec :  
✔ Une structure **MVC propre**  
✔ Des **validations robustes**  
✔ Une **expérience utilisateur fluide**  

**Améliorations possibles :**  
- Ajouter un système de **paiement en ligne**  
- Intégrer une **API de géolocalisation**  
- Développer une **application mobile complémentaire**  

---

📄 **Ce PDF est généré automatiquement.** Pour le code source complet, visitez :  
[GitHub Repository](https://github.com/votre-utilisateur/car-rental-app)  

© 2023 - Tous droits réservés.
