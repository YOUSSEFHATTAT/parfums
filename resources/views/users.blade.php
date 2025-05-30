@extends('layouts.master')

@section('title', 'Utilisateurs')

@section('main')
<style>
    .role-badge,.users-table th{text-transform:uppercase;letter-spacing:.5px}:root{--primary:#0e4c92;--primary-dark:#072a54;--accent:#ff6b6b;--success:#28a745;--warning:#ffc107;--text:#333;--text-muted:#6c757d;--bg:#fff;--bg-gray:#f8f9fa;--border:#e2e8f0;--shadow:0 4px 20px rgba(0,0,0,0.1);--shadow-sm:0 2px 10px rgba(0,0,0,0.05);--radius:12px;--transition:all 0.3s ease}.role-select,.search-btn,.search-input,.users-table tbody tr{transition:var(--transition)}.users-container{max-width:1200px;margin:0 auto;padding:20px}.page-header{background:var(--bg-gray);border-radius:var(--radius);padding:30px;margin-bottom:30px;box-shadow:var(--shadow-sm);border-left:8px solid var(--primary);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:20px}.page-header h1{font:700 2.2rem/1 sans-serif;color:var(--primary-dark);margin:0}.search-form{display:flex;gap:10px;min-width:300px}.search-input{flex:1;padding:12px 16px;border:2px solid var(--border);border-radius:8px;font-size:1rem;background:var(--bg)}.role-select:focus,.search-input:focus{outline:0;border-color:var(--primary);box-shadow:0 0 0 3px rgba(14,76,146,.1)}.search-btn{background:var(--primary);color:#fff;border:none;padding:12px 20px;border-radius:8px;font-weight:600;cursor:pointer;white-space:nowrap}.search-btn:hover{background:var(--primary-dark);transform:translateY(-2px)}.users-table-container{background:var(--bg);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden}.users-table{width:100%;border-collapse:collapse;font-size:.95rem}.users-table thead{background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:#fff}.users-table th{padding:20px 16px;text-align:left;font-weight:600;font-size:.9rem}.users-table tbody tr{border-bottom:1px solid var(--border);animation:.5s forwards fadeInUp}.users-table tbody tr:hover{background:var(--bg-gray);transform:scale(1.01)}.users-table tbody tr:last-child{border-bottom:none}.users-table td{padding:16px;vertical-align:middle}.user-id{font-weight:700;color:var(--primary);background:rgba(14,76,146,.1);padding:4px 8px;border-radius:4px;display:inline-block;min-width:40px;text-align:center}.user-name{font-weight:600;color:var(--text)}.user-email{color:var(--text-muted);font-family:'Courier New',monospace;font-size:.9rem}.role-badge{padding:6px 12px;border-radius:20px;font-size:.8rem;font-weight:600}.role-user{background:#e3f2fd;color:#1976d2}.role-admin{background:#fff3e0;color:#f57c00}.role-select{padding:8px 12px;border:2px solid var(--border);border-radius:8px;background:var(--bg);color:var(--text);font-weight:600;cursor:pointer;min-width:140px}.role-select:hover{border-color:var(--primary)}.no-users{text-align:center;padding:60px 20px;color:var(--text-muted)}.no-users i{font-size:4rem;margin-bottom:20px;color:var(--border)}.no-users h3{margin-bottom:10px;color:var(--text)}.role-select.loading{opacity:.6;pointer-events:none}@keyframes fadeInUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}@media (max-width:768px){.page-header{flex-direction:column;align-items:stretch;text-align:center}.search-form{min-width:auto}.users-table-container{overflow-x:auto}.users-table{min-width:600px}.users-table td,.users-table th{padding:12px 8px}.page-header h1{font-size:1.8rem}}@media (max-width:576px){.users-container{padding:10px}.page-header{padding:20px}.search-form{flex-direction:column}.users-table td,.users-table th{padding:10px 6px;font-size:.85rem}}
</style>

<div class="users-container">
    <div class="page-header">
        <h1><i class="fas fa-users"></i> Gestion des Utilisateurs</h1>
        <form action="{{ route('usersliste') }}" method="GET" class="search-form">
            <input 
                type="text" 
                name="search" 
                class="search-input" 
                placeholder="🔍 Rechercher par email..." 
                value="{{ request('search') }}"
            >
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </form>
    </div>

    <div class="users-table-container">
        @if($users->count() > 0)
            <table class="users-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-user"></i> Nom</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-shield-alt"></i> Rôle</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr style="animation-delay: {{ $index * 0.1 }}s">
                            <td>
                                <span class="user-id">#{{ $user->id }}</span>
                            </td>
                            <td>
                                <div class="user-name">{{ $user->nom }}</div>
                            </td>
                            <td>
                                <div class="user-email">{{ $user->email }}</div>
                            </td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    @if($user->role === 'admin')
                                        Administrateur
                                    @else
                                        Utilisateur
                                    @endif
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <select 
                                        name="role" 
                                        onchange="this.form.submit()" 
                                        class="role-select"
                                        title="Changer le rôle de {{ $user->nom }}"
                                    >
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                             Utilisateur
                                        </option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                            Administrateur
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-users">
                <i class="fas fa-users-slash"></i>
                <h3>Aucun utilisateur trouvé</h3>
                <p>
                    @if(request('search'))
                        Aucun résultat pour "{{ request('search') }}"
                    @else
                        Il n'y a pas encore d'utilisateurs dans le système.
                    @endif
                </p>
            </div>
        @endif
    </div>

    @if($users->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to role selects
    document.querySelectorAll('.role-select').forEach(select => {
        select.addEventListener('change', function() {
            this.classList.add('loading');
        });
    });

    // Auto-focus search input if there's a search term
    const searchInput = document.querySelector('.search-input');
    if (searchInput && searchInput.value) {
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }
});
</script>
@endsection