// admin.js — Suppression captures AJAX
document.querySelectorAll('.capture-delete').forEach(btn => {
    btn.addEventListener('click', async function() {
        if (!confirm('Supprimer cette capture ?')) return;
        const id = this.dataset.id;
        const res = await fetch(`/admin/captures/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content }
        });
        if (res.ok) this.closest('.capture-item').remove();
    });
});