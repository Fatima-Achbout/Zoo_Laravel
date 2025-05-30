
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Animaux</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #2c9c5a;
            --secondary-color: #145a32;
            --accent-color: #3498db;
            --danger-color: #e74c3c;
            --light-gray: #f8f9fa;
            --gray: #6c757d;
            --dark-gray: #343a40;
            --success-bg: #d4edda;
            --success-color: #155724;
            --error-bg: #f8d7da;
            --error-color: #721c24;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1100px; /* Un peu moins large car moins de colonnes */
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background-color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h1 {
            color: var(--dark-gray);
            margin: 0;
            font-size: 28px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-add {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-add:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: var(--gray);
            color: white;
            margin-right: 10px;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid transparent;
        }

        .alert-success {
            color: var(--success-color);
            background-color: var(--success-bg);
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: var(--error-color);
            background-color: var(--error-bg);
            border-color: #f5c6cb;
        }
        #alert-success-js, #alert-error-js {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        #alert-success-js.show, #alert-error-js.show {
            display: block;
            opacity: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: var(--light-gray);
            font-weight: 600;
            color: var(--dark-gray);
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-btn {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            margin-right: 10px;
            color: var(--gray);
            transition: color 0.2s;
            padding: 5px;
        }

        .action-edit:hover {
            color: var(--accent-color);
        }

        .action-delete:hover {
            color: var(--danger-color);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
            margin-right: 15px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary-color);
        }

        input:checked + .slider:before {
            transform: translateX(30px);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .close {
            color: var(--gray);
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover {
            color: var(--dark-gray);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .modal-title {
            margin-top: 0;
            color: var(--dark-gray);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-gray);
        }

        input[type="text"], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, select:focus, textarea:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.25);
        }

        .form-actions {
            margin-top: 30px;
            text-align: right;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: var(--gray);
            font-style: italic;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
                margin: 10% auto;
            }
            header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            h1 {
                margin-bottom: 15px;
            }
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <header>
            <h1>Liste des Animaux</h1>
            <button class="btn btn-add" onclick="openAddModal()">Ajouter un animal</button>
        </header>

        @if (session('success'))
            <div class="alert alert-success" id="alert-success-server" style="opacity: 1;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="opacity: 1;">
                <strong>Oups !</strong> Il y avait quelques problèmes avec votre saisie.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="alert alert-success" id="alert-success-js"></div>
        <div class="alert alert-danger" id="alert-error-js"></div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Espèce</th>
                    <th>Habitat</th>
                    <th>Origine</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> {{-- Retiré l'id animals-table-body, Blade gère l'affichage --}}
                @forelse ($animals as $animal)
                <tr>
                    <td>{{ $animal->id }}</td>
                    <td>{{ $animal->name }}</td>
                    <td>{{ $animal->species }}</td>
                    <td>{{ $animal->habitat ?? '-' }}</td>
                    <td>{{ $animal->origin ?? '-' }}</td>
                    <td>
                        <span class="status-badge {{ $animal->status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ $animal->status === 'active' ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>
                        <label class="toggle-switch">
                            <input type="checkbox" {{ $animal->status === 'active' ? 'checked' : '' }} onchange="toggleStatus({{ $animal->id }})">
                            <span class="slider"></span>
                        </label>
                        <button class="action-btn action-edit"
                                onclick="openEditModal(
                                    {{ $animal->id }},
                                    '{{ addslashes($animal->name) }}',
                                    '{{ addslashes($animal->species) }}',
                                    '{{ addslashes($animal->habitat ?? '') }}',
                                    '{{ addslashes($animal->origin ?? '') }}',
                                    '{{ $animal->status }}'
                                    {{-- Plus de paramètre imageUrl ici --}}
                                )">
                            ✏️
                        </button>
                        <form action="{{ route('admin.animals.destroy', $animal->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ addslashes($animal->name) }} ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn action-delete">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    {{-- Ajusté colspan car il y a une colonne en moins --}}
                    <td colspan="7" class="no-data">Aucun animal trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal pour ajouter/modifier un animal -->
    <div id="animalModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">×</span>
            <h2 id="modal-title" class="modal-title">Ajouter un animal</h2>
            <form id="animalForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="formMethodField" value="POST">

                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="species">Espèce:</label>
                    <input type="text" id="species" name="species" required>
                </div>
                <div class="form-group">
                    <label for="habitat">Habitat:</label>
                    <input type="text" id="habitat" name="habitat">
                </div>
                <div class="form-group">
                    <label for="origin">Origine:</label>
                    <input type="text" id="origin" name="origin">
                </div>
                {{-- Champ image supprimé du formulaire --}}
                <div class="form-group">
                    <label for="status">Statut:</label>
                    <select id="status" name="status">
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn btn-submit">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let animalModal, modalTitle, animalForm, formMethodField;
        let nameInput, speciesInput, habitatInput, originInput, statusInput;
        // imageUrlInput et imagePreview ne sont plus nécessaires

        document.addEventListener('DOMContentLoaded', function() {
            animalModal = document.getElementById('animalModal');
            modalTitle = document.getElementById('modal-title');
            animalForm = document.getElementById('animalForm');
            formMethodField = document.getElementById('formMethodField');

            nameInput = document.getElementById('name');
            speciesInput = document.getElementById('species');
            habitatInput = document.getElementById('habitat');
            originInput = document.getElementById('origin');
            statusInput = document.getElementById('status');

            const serverSuccessAlert = document.getElementById('alert-success-server');
            if (serverSuccessAlert) {
                setTimeout(() => {
                    serverSuccessAlert.style.transition = 'opacity 0.5s ease';
                    serverSuccessAlert.style.opacity = '0';
                    setTimeout(() => serverSuccessAlert.style.display = 'none', 500);
                }, 5000);
            }
        });

        function openAddModal() {
            if (!animalModal || !modalTitle || !animalForm || !formMethodField) {
                console.error('Éléments du modal manquants pour openAddModal.');
                return;
            }
            modalTitle.textContent = 'Ajouter un animal';
            animalForm.action = "{{ route('admin.animals.store') }}";
            formMethodField.value = "POST";
            animalForm.reset();
            // Plus de gestion d'aperçu d'image

            animalModal.style.display = 'block';
            setTimeout(() => animalModal.classList.add('show'), 10);
        }

        // La signature de openEditModal change, plus de imageUrl
        function openEditModal(id, name, species, habitat, origin, status) {
            if (!animalModal || !modalTitle || !animalForm || !formMethodField) {
                console.error('Éléments du modal manquants pour openEditModal.');
                return;
            }
            modalTitle.textContent = 'Modifier un animal';
            animalForm.action = `/admin/animals/${id}`;
            formMethodField.value = "PUT";

            if (nameInput) nameInput.value = name;
            if (speciesInput) speciesInput.value = species;
            if (habitatInput) habitatInput.value = habitat || '';
            if (originInput) originInput.value = origin || '';
            if (statusInput) statusInput.value = status;
            // Plus de gestion d'aperçu d'image

            animalModal.style.display = 'block';
            setTimeout(() => animalModal.classList.add('show'), 10);
        }

        function closeModal() {
            if (!animalModal) return;
            animalModal.classList.remove('show');
            setTimeout(() => {
                animalModal.style.display = 'none';
                if (animalForm) animalForm.reset();
                // Plus de gestion d'aperçu d'image
            }, 300);
        }

        function showAlert(message, type = 'success') {
            const alertBoxId = (type === 'success') ? 'alert-success-js' : 'alert-error-js';
            const alertBox = document.getElementById(alertBoxId);
            if (alertBox) {
                alertBox.textContent = message;
                alertBox.className = `alert alert-${type} show`;
                alertBox.style.display = 'block';
                alertBox.style.opacity = '1';
                setTimeout(() => {
                    alertBox.style.opacity = '0';
                    setTimeout(() => {
                        alertBox.style.display = 'none';
                        alertBox.classList.remove('show');
                    } , 500);
                }, 3000);
            } else {
                console.warn(`Alerte JS: Div id="${alertBoxId}" manquante. Msg: ${message}`);
            }
        }

        function toggleStatus(animalId) {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

            if (!csrfToken) {
                console.error('CSRF token non trouvé.');
                showAlert('Erreur de configuration (CSRF).', 'error');
                return;
            }

            fetch(`/admin/animals/${animalId}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        const serverMessage = err.message || (err.errors ? Object.values(err.errors).join(', ') : `Erreur HTTP ${response.status}`);
                        throw new Error(serverMessage);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    showAlert(data.message || 'Impossible de mettre à jour le statut.', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur toggleStatus:', error);
                showAlert(`Erreur: ${error.message || 'Une erreur réseau est survenue.'}`, 'error');
            });
        }

        // previewImageUrl() n'est plus nécessaire

        window.onclick = function(event) {
            if (animalModal && event.target === animalModal) {
                closeModal();
            }
        };
    </script>
</body>
</html>