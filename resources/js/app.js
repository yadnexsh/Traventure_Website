import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('trekDiscovery', () => ({
    activeMonth: null,
    activeSeason: null,
    activeDifficulty: null,

    toggleMonth(month) {
        this.activeMonth = this.activeMonth === month ? null : month;
    },

    toggleSeason(season) {
        this.activeSeason = this.activeSeason === season ? null : season;
        this.activeDifficulty = null;
    },

    toggleDifficulty(difficulty) {
        this.activeDifficulty = this.activeDifficulty === difficulty ? null : difficulty;
    },

    clearFilters() {
        this.activeMonth = null;
        this.activeSeason = null;
        this.activeDifficulty = null;
    },

    buildUrl() {
        const baseUrl = window.treksBaseUrl || '/treks';
        const url = new URL(baseUrl, window.location.origin);
        if (this.activeMonth) url.searchParams.append('month', this.activeMonth);
        if (this.activeSeason) url.searchParams.append('season', this.activeSeason);
        if (this.activeDifficulty) url.searchParams.append('difficulty', this.activeDifficulty);
        return url.toString();
    }
}));

Alpine.start();

const mediaFiles = import.meta.glob([
  '../media/**',
]);
