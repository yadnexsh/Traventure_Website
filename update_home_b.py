import re

path = 'H:/Pr - Traventure/Traventure_Concept_B/resources/views/home.blade.php'
with open(path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the Discovery section up to "WHAT ARE YOU LOOKING FOR?"
start_str = "{{-- DISCOVERY INTRODUCTION --}}"
end_str = "{{-- WHAT ARE YOU LOOKING FOR? --}}"

start_idx = content.find(start_str)
end_idx = content.find(end_str)

if start_idx != -1 and end_idx != -1:
    new_discovery = """{{-- DISCOVERY INTRODUCTION / HERO --}}
<div class="bg-bg-base pt-32 pb-40 border-b border-border-subtle min-h-[60vh] flex flex-col justify-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        
        <div class="mb-16 text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-text-primary tracking-tight mb-8">Where travel meets true adventure.</h1>
            <p class="text-xl md:text-2xl text-text-secondary font-light">Explore treks by month, season and difficulty to find the trail that fits you.</p>
        </div>

        {{-- 1. Treks by Month --}}
        <div class="mb-12 relative">
            <div class="flex overflow-x-auto pb-4 justify-between md:justify-center md:gap-6 lg:gap-10 scrollbar-hide snap-x px-4 md:px-0">
                @foreach(['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'] as $month)
                    <a href="{{ route('treks.index', ['month' => $month]) }}" 
                        class="snap-start flex-none text-xl md:text-2xl text-text-muted hover:text-brand-primary transition-colors focus:outline-none uppercase font-light">
                        {{ substr($month, 0, 3) }}
                    </a>
                @endforeach
            </div>
            <div class="h-px w-full bg-border-subtle mt-2"></div>
        </div>
        
        {{-- Treks by Season & Difficulty (Collapsible Panel) --}}
        <div x-data="{ expanded: false, season: '', difficulty: '' }" class="max-w-4xl mx-auto border border-border-strong bg-bg-subtle/30 rounded-sm">
            <button @click="expanded = !expanded" class="w-full flex items-center justify-between px-8 py-6 focus:outline-none hover:bg-bg-subtle transition-colors">
                <span class="text-lg font-bold tracking-[0.1em] uppercase text-text-primary">What are you looking for?</span>
                <span x-text="expanded ? '−' : '+'" class="text-2xl font-light text-text-muted"></span>
            </button>
            
            <div x-show="expanded" x-transition class="px-8 pb-8 border-t border-border-subtle pt-8" style="display: none;">
                <div class="flex flex-col md:flex-row gap-12">
                    {{-- Seasons --}}
                    <div class="flex-1">
                        <h3 class="text-xs font-bold text-text-muted uppercase tracking-[0.2em] mb-6">Season</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach([
                                'Winter' => 'Snow possible',
                                'Summer' => 'High-altitude',
                                'Monsoon' => 'Lush & rainfall',
                                'Spring' => 'Blooming trails',
                                'Autumn' => 'Clearer skies'
                            ] as $s => $desc)
                                <button @click="season = season === '{{ $s }}' ? '' : '{{ $s }}'" 
                                    :class="season === '{{ $s }}' ? 'bg-text-primary text-bg-base border-text-primary' : 'bg-transparent text-text-secondary border-border-strong hover:border-text-muted'"
                                    class="flex flex-col items-start p-4 border transition-colors focus:outline-none text-left rounded-sm w-full">
                                    <span class="uppercase tracking-widest font-bold text-xs mb-1">{{ $s }}</span>
                                    <span class="text-[10px] font-light opacity-70">{{ $desc }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Difficulty --}}
                    <div class="flex-1">
                        <h3 class="text-xs font-bold text-text-muted uppercase tracking-[0.2em] mb-6">Difficulty</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach([
                                'Easy' => 'For beginners',
                                'Moderate' => 'Basic fitness',
                                'Hard' => 'Experienced',
                                'Expert' => 'Technical skills'
                            ] as $d => $desc)
                                <button @click="difficulty = difficulty === '{{ $d }}' ? '' : '{{ $d }}'" 
                                    :class="difficulty === '{{ $d }}' ? 'bg-text-primary text-bg-base border-text-primary' : 'bg-transparent text-text-secondary border-border-strong hover:border-text-muted'"
                                    class="flex flex-col items-start p-4 border transition-colors focus:outline-none text-left rounded-sm w-full">
                                    <span class="uppercase tracking-widest font-bold text-xs mb-1">{{ $d }}</span>
                                    <span class="text-[10px] font-light opacity-70">{{ $desc }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="mt-10 flex justify-end">
                    <button @click="window.location.href = '{{ route('treks.index') }}?season=' + season + '&difficulty=' + difficulty" 
                        class="inline-flex items-center justify-center font-bold text-sm tracking-[0.2em] uppercase px-10 py-4 bg-brand-primary text-white hover:bg-brand-secondary transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary">
                        Explore Treks
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

"""
    content = content[:start_idx] + new_discovery + content[end_idx:]
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    print("home.blade.php updated.")
else:
    print("Could not find section in home.blade.php")
