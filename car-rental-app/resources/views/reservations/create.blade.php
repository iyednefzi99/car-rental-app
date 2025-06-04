<form method="POST" action="{{ route('reservations.store') }}">
    @csrf
    <div class="mb-3">
        <label>Voiture</label>
        <select name="voiture_id" class="form-select" required>
            @foreach($cars as $car)
                <option value="{{ $car->id }}">{{ $car->marque }} {{ $car->modèle }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Dates</label>
        <input type="date" name="date_debut" class="form-control" required>
        <input type="date" name="date_fin" class="form-control mt-2" required>
    </div>
    <button type="submit" class="btn btn-primary">Réserver</button>
</form>