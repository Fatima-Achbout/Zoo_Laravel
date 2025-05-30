<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooAdmin - Tableau de Bord</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.9.1/chart.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        /* Pour forcer la translation -100% sur l'axe X */
.-translate-x-full {
    transform: translateX(-100%) !important;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 12px 15px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

tbody tr:hover {
  background-color: #f1f1f1;
}


        .bg-zoo-primary {
            background-color: #0F5940;
        }
        .bg-zoo-secondary {
            background-color: #1A7B57;
        }
        .hover-zoo:hover {
            background-color: #1A7B57;
        }
        .border-zoo {
            border-color: #0F5940;
        }
        .text-zoo {
            color: #0F5940;
        }
        .card-zoom {
            transition: all 0.3s;
        }
        .card-zoom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }
        .sidebar-icon {
            transition: all 0.2s;
        }
        .nav-link:hover .sidebar-icon {
            transform: translateX(5px);
        }
        .status-badge {
            transition: all 0.3s;
        }
        .status-badge:hover {
            transform: scale(1.1);
        }
        .avatar-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Style pour la transition de la marge du contenu principal */
        #main-content {
            transition: margin-left 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans overflow-x-hidden"> <!-- overflow-x-hidden pour éviter la barre de scroll horizontale -->
    <div class="flex h-screen relative">
        <!-- Sidebar -->
        <div id="main-sidebar"
             class="w-64 bg-zoo-primary text-white shadow-lg
                    fixed inset-y-0 left-0 z-40 h-full
                    transform transition-transform duration-300 ease-in-out
                    md:translate-x-0">
            <!-- La classe -translate-x-full sera ajoutée/retirée par JS pour l'état initial mobile -->

            <div class="p-4 flex items-center border-b border-green-700">
                <img src="{{ asset('images\dash\fil.png') }}" alt="Logo Zoo" class="h-10 w-10 rounded-lg shadow mr-3">
                <span class="text-xl font-bold tracking-wider">Zoo Admin</span>
            </div>

            

            <div class="mt-6">
                <div class="text-green-300 text-xs uppercase font-semibold tracking-wider px-6 mb-4">MENU</div>

                <a href="{{ route('dashboard') }}" class="nav-link flex items-center text-white px-6 py-3 hover-zoo mb-1 border-l-4 border-green-400">
                    <i class="fas fa-tachometer-alt sidebar-icon mr-3 text-lg"></i>
                    <span>Tableau de bord</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="nav-link flex items-center text-gray-300 px-6 py-3 hover-zoo mb-1 border-l-4 border-transparent">
                    <i class="fas fa-users sidebar-icon mr-3 text-lg"></i>
                    <span>Utilisateurs</span>
                </a>

                <a href="{{ route('admin.tickets.index') }}
                    " class="nav-link flex items-center text-gray-300 px-6 py-3 hover-zoo mb-1 border-l-4 border-transparent">
                    <i class="fas fa-ticket-alt sidebar-icon mr-3 text-lg"></i>
                    <span>Billets</span>
                </a>

                <a href="{{ route('admin.animals.index') }}
                    " class="nav-link flex items-center text-gray-300 px-6 py-3 hover-zoo mb-1 border-l-4 border-transparent">
                    <i class="fas fa-paw sidebar-icon mr-3 text-lg"></i>
                    <span>Animaux</span>
                </a>

                <div class="text-green-300 text-xs uppercase font-semibold tracking-wider px-6 mt-8 mb-4">CONFIGURATION</div>

                <a href="#" class="nav-link flex items-center text-gray-300 px-6 py-3 hover-zoo mb-1 border-l-4 border-transparent"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt sidebar-icon mr-3 text-lg"></i>
    <span>Déconnexion</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main-content"
             class="flex-1 flex flex-col overflow-hidden
                    transition-all duration-300 ease-in-out"> <!-- Marge initiale pour desktop -->

            <!-- Top Navigation -->
            <header class="bg-white shadow sticky top-0 z-30">
                <div class="flex items-center justify-between px-6 py-3">
                    <div class="flex items-center">
                        <button id="sidebar-toggle-button" class="text-gray-500 focus:outline-none mr-6">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    

                    
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Tableau de Bord</h1>
                    <div class="flex items-center">
                        <span class="text-gray-500 mr-2">{{ date('d/m/Y') }}</span>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-zoom border-t-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-500">Total Utilisateurs</div>
                                <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers ?? 1253 }}</div>
                            </div>
                            <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm font-medium text-green-500">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>12% cette semaine</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-zoom border-t-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-500">Billets Vendus</div>
                                <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalTicketsSold }}</div>
                            </div>
                            <div class="h-14 w-14 rounded-full bg-green-100 flex items-center justify-center text-green-500">
                                <i class="fas fa-ticket-alt text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm font-medium text-green-500">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>23% ce mois</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-zoom border-t-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-500">Revenus</div>
                                <div class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalRevenue, 2) }} MAD</div>
                            </div>
                            <div class="h-14 w-14 rounded-full bg-purple-100 flex items-center justify-center text-purple-500">
<i class="fas fa-money-bill-wave text-2xl"></i> د.م.
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm font-medium text-green-500">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>8% ce mois</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-zoom border-t-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-500">Types de billets</div>
                                <div class="text-3xl font-bold text-gray-800 mt-2">3</div>
                            </div>
                            <div class="h-14 w-14 rounded-full bg-orange-100 flex items-center justify-center text-orange-500">
                                <i class="fas fa-tags text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm font-medium text-gray-400">
                            <i class="fas fa-equals mr-1"></i>
                            <span>Inchangé</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="font-bold text-gray-800 text-lg">Dernières transactions</h2>
                        <!-- <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                                Aujourd'hui
                            </button>
                            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                                Cette semaine
                            </button>
                            <button class="px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                                Ce mois
                            </button>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border px-4 py-2">Visiteur</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border px-4 py-2">Type de billet</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border px-4 py-2">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border px-4 py-2">Prix</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border px-4 py-2">Date</th>
                                </tr>
                            </thead>
                        
                            <tbody class="bg-white divide-y divide-gray-200">
   @forelse($orders as $order)
            <tr>
                <td>{{ $order->user ? $order->user->name : 'Utilisateur inconnu' }}</td>
                <td>
    @foreach ($order->groupedTickets as $ticket)
        {{ $ticket['type'] }}
        @if ($ticket['quantity'] > 1)
            (x{{ $ticket['quantity'] }})
        @endif
        @if (!$loop->last), @endif
    @endforeach
</td>

                <td>{{ $order->status == 1 ? 'Payé' : 'En attente' }}</td>
                <td>{{ number_format($order->amount, 2) }} MAD</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Aucune transaction trouvée.</td>
            </tr>
        @endforelse
</tbody>

                        </table>
                    </div>
                    <div class="px-6 py-4 flex items-center justify-between border-t border-gray-200">       
                        <div class="flex items-center">
                            <button class="px-3 py-1 rounded-lg border border-green-500 bg-green-500 text-white text-sm">1</button>
                            <!-- ... autres boutons de pagination ... -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Overlay pour mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-0 z-30 hidden transition-opacity duration-300 ease-in-out md:hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggleButton = document.getElementById('sidebar-toggle-button');
            const mainSidebar = document.getElementById('main-sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            function isMobileScreen() {
                return window.innerWidth < 768; // md breakpoint
            }

            // Appliquer l'état initial au chargement
            function setInitialSidebarState() {
                if (isMobileScreen()) {
                    mainSidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('md:ml-64'); // Assurer pas de marge desktop sur mobile
                    mainContent.classList.add('ml-0');      // Explicitement pas de marge
                } else {
                    mainSidebar.classList.remove('-translate-x-full');
                    mainContent.classList.add('md:ml-64');
                    mainContent.classList.remove('ml-0');
                }
            }
            setInitialSidebarState(); // Appeler à l'initialisation


            function toggleSidebar() {
    mainSidebar.classList.toggle('-translate-x-full');

    if (mainSidebar.classList.contains('-translate-x-full')) {
        // Sidebar cachée
        sidebarOverlay.classList.add('hidden');
        sidebarOverlay.classList.remove('opacity-50');

        // Contenu prend toute la largeur
        mainContent.classList.add('ml-0');
        mainContent.classList.remove('md:ml-64');
    } else {
        // Sidebar visible
        if (isMobileScreen()) {
            sidebarOverlay.classList.remove('hidden');
            // Forcer le reflow pour transition
            void sidebarOverlay.offsetWidth;
            sidebarOverlay.classList.add('opacity-50');

            // Pas de marge sur mobile
            mainContent.classList.add('ml-0');
            mainContent.classList.remove('md:ml-64');
        } else {
            sidebarOverlay.classList.add('hidden');
            sidebarOverlay.classList.remove('opacity-50');

            // Marge pour le contenu desktop quand sidebar visible
            mainContent.classList.remove('ml-0');
            mainContent.classList.add('md:ml-64');
        }
    }
}


            if (sidebarToggleButton) {
                sidebarToggleButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    toggleSidebar();
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function () {
                     // Fermer la sidebar seulement si elle est ouverte et qu'on est sur mobile
                    if (isMobileScreen() && !mainSidebar.classList.contains('-translate-x-full')) {
                        toggleSidebar();
                    }
                });
            }

            window.addEventListener('resize', function() {
                // Réappliquer l'état correct lors du redimensionnement
                // Surtout pour passer de mobile à desktop et vice-versa
                setInitialSidebarState();
                // Si la sidebar était ouverte sur mobile et qu'on redimensionne en desktop,
                // l'overlay doit disparaître.
                if (!isMobileScreen()) {
                    sidebarOverlay.classList.add('hidden');
                    sidebarOverlay.classList.remove('opacity-50');
                } else {
                    // Si on redimensionne vers mobile et que la sidebar est ouverte, l'overlay doit être visible
                    if(!mainSidebar.classList.contains('-translate-x-full')) {
                        sidebarOverlay.classList.remove('hidden');
                        sidebarOverlay.classList.add('opacity-50');
                    } else {
                        sidebarOverlay.classList.add('hidden');
                        sidebarOverlay.classList.remove('opacity-50');
                    }
                }
            });
        });
    </script>
</body>
</html>