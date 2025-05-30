@extends('layouts.master')

@section('title', 'Boîte de Réception')

@section('main')
<style>
   .inbox-empty,.message-card{background-color:var(--bg-gray)}.btn-mark-processed:hover,.page-item.active .page-link{background-color:var(--primary-color);color:var(--bg-light)}:root{--primary-color:#D4AF37;--primary-light:#F8E9A1;--primary-dark:#A67C00;--accent-color:#D4AF37;--text-light:#F8E9A1;--text-dark:#000000;--text-muted:#A67C00;--bg-light:#000000;--bg-gray:#111111;--shadow-sm:0 2px 10px rgba(212, 175, 55, 0.15);--shadow-md:0 4px 20px rgba(212, 175, 55, 0.2);--shadow-lg:0 10px 30px rgba(212, 175, 55, 0.3)}body{background-color:var(--bg-light);color:var(--text-light)}.inbox-container{max-width:1200px;margin:0 auto;padding:2rem 1rem}.inbox-header{display:flex;align-items:center;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--primary-dark)}.inbox-empty,.message-header{padding:1rem 1.25rem;display:flex}.inbox-title{font-size:1.75rem;font-weight:700;color:var(--primary-color);margin:0;display:flex;align-items:center;gap:.5rem;text-transform:uppercase;letter-spacing:1px}.btn-mark-processed,.message-subject{text-transform:uppercase;letter-spacing:.5px}.inbox-icon{font-size:1.5rem}.inbox-empty{border-left:4px solid var(--primary-color);color:var(--text-light);align-items:center;gap:.75rem;font-weight:500;border:1px solid var(--primary-dark);border-left-width:4px}.message-card{box-shadow:var(--shadow-sm);margin-bottom:1rem;overflow:hidden;transition:.2s;border:1px solid var(--primary-dark)}.message-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px);border-color:var(--primary-color)}.message-header{justify-content:space-between;align-items:center;background-color:rgba(212,175,55,.1);border-bottom:1px solid var(--primary-dark)}.message-sender{display:flex;flex-direction:column}.message-name{font-weight:600;color:var(--text-light);font-size:1.05rem}.message-email{color:var(--primary-color);font-size:.9rem;font-weight:500}.btn-mark-processed i,.message-date{font-size:.85rem}.message-date{color:var(--text-muted);display:flex;align-items:center;gap:.5rem}.message-body{padding:1.25rem}.message-subject{font-weight:600;margin-bottom:.75rem;color:var(--primary-color);font-size:1.05rem}.message-content{color:var(--text-light);line-height:1.5;margin-bottom:1.25rem}.btn-mark-processed,.page-link{color:var(--primary-color);transition:.2s}.message-actions{display:flex;justify-content:flex-end;gap:.5rem}.btn-mark-processed{display:inline-flex;align-items:center;gap:.5rem;background-color:transparent;border:1px solid var(--primary-color);padding:.5rem 1rem;font-weight:500;font-size:.9rem;cursor:pointer}.pagination-container{margin-top:2rem;display:flex;justify-content:center}.pagination{display:flex;list-style:none;padding:0;gap:.5rem}.page-item{display:inline-block}.page-item.active .page-link{border-color:var(--primary-color)}.page-link{display:flex;align-items:center;justify-content:center;width:2.5rem;height:2.5rem;background-color:var(--bg-gray);border:1px solid var(--primary-dark);text-decoration:none}.page-link:hover{background-color:var(--primary-dark);color:var(--text-light)}@media (max-width:768px){.message-header{flex-direction:column;align-items:flex-start;gap:.5rem}.message-date{align-self:flex-start}}
</style>

<div class="inbox-container">
    <div class="inbox-header">
        <h1 class="inbox-title">
            <span class="inbox-icon">📥</span>
            MESSAGES REÇUS
        </h1>
    </div>

    @if($messages->isEmpty())
        <div class="inbox-empty">
            <i class="fas fa-info-circle"></i>
            Aucun message reçu pour le moment.
        </div>
    @else
        <div class="messages-list">
            @foreach ($messages as $message)
                <div class="message-card">
                    <div class="message-header">
                        <div class="message-sender">
                            <div class="message-email">{{ $message->email }}</div>
                        </div>
                        <div class="message-date">
                            <i class="far fa-clock"></i>
                            {{ $message->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="message-body">
                        <div class="message-subject">{{ $message->sujet }}</div>
                        <div class="message-content">{{ Str::limit($message->contenu, 150) }}</div>
                        <div class="message-actions">
                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-mark-processed" onclick="return confirm('Êtes-vous sûr de vouloir marquer ce message comme traité ?')">
                                    <i class="fas fa-check"></i> MARQUER COMME TRAITÉ
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection