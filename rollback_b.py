import re

old_home_path = 'H:/Pr - Traventure/Traventure_Website/scratch/old_home.blade.php'
new_home_path = 'H:/Pr - Traventure/Traventure_Concept_B/resources/views/home.blade.php'

with open(old_home_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Step 2: Fix the hero heading
# Original: <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-text-primary tracking-tight mb-6">Your next adventure</h2>
# Replace with: <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-text-primary tracking-tight mb-6 whitespace-normal md:whitespace-nowrap">Where travel meets true adventure.</h2>
# And keep the original description: <p class="text-xl md:text-2xl text-text-secondary font-light">Find the trail that fits your time, your season and your spirit.</p>

content = content.replace(
    '<h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-text-primary tracking-tight mb-6">Your next adventure</h2>',
    '<h2 class="text-3xl md:text-4xl lg:text-[40px] xl:text-[48px] font-bold text-text-primary tracking-tight mb-6 whitespace-normal md:whitespace-nowrap leading-tight">Where travel meets true adventure.</h2>'
)

# Step 3: Restore the original Treks by Month section
# In old_home.blade.php, it's already there! But wait, they said "Remove this newly introduced description 'Explore treks by month...'".
# Since I'm restoring from old_home.blade.php, I don't need to remove it because it doesn't exist in old_home.blade.php!
# Wait, let's verify if "Explore treks by month..." was in old_home.blade.php.
# In old_home.blade.php:
# <p class="text-xl md:text-2xl text-text-secondary font-light">Find the trail that fits your time, your season and your spirit.</p>
# It's not there! So restoring from old_home automatically fixes it.

# Step 4: Remove only the duplicate discovery box
# Restoring from old_home automatically removes the duplicate!
# The original "What are you looking for?" is at line 311.

# Step 5: Restore the missing season panels
# They are present in old_home.blade.php (lines 173-202).

# Step 6: Preserve functional fixes
# In my previous step, I made it so that clicking Month/Season/Difficulty navigated to the Listing Page instead of filtering inline on the homepage!
# The prompt says: "Preserve functional fixes: Backend listing filters, Month, season and difficulty query handling, Correct unfiltered listing behavior. Search and Clear filters."
# BUT wait! If I restore `old_home.blade.php`, the homepage will go back to filtering the inline MATCHING TREKS grid!
# The previous prompt said: "Remove homepage trek results... Do not render the matching trek cards or results grid on the homepage... Selecting a month must navigate to the trek listing page with the month filter applied... The user clicks an explicit action such as 'Explore Treks' to open the dedicated listing page with the selected filters applied."
# This prompt says: "The previous homepage redesign did not work as intended. Do not perform another complete redesign... Step 5: Restore the missing season panels... Restore them within the original discovery section... Step 6: Preserve functional fixes... Do not revert the entire implementation. Preserve the following if verified to work: Month, season and difficulty query handling."
# So I must KEEP the season panels, BUT they must navigate to the listing page! OR do they filter inline?
# "Do not revert the entire implementation... Preserve month, season and difficulty query handling."
# If I just restore `old_home.blade.php`, it will filter inline using Alpine, and it HAS a Matching Treks results grid. Should I remove the Matching Treks results grid?
# The previous prompt explicitly said: "Remove homepage trek results. Remove the entire trek results/matching section from the homepage UI in Concept B."
# This new prompt DOES NOT say "Restore the matching treks grid." It only says "Restore the original Treks by Month section... Remove the duplicate discovery box... Restore the missing season panels."
# So I MUST REMOVE the Matching Treks grid from `old_home.blade.php` and make the controls navigate to `/treks`!

# So:
# 1. Remove the "MATCHING TREKS RESULTS" section from old_home.blade.php.
matching_treks_start = '{{-- MATCHING TREKS RESULTS --}}'
matching_treks_end = '{{-- WHAT ARE YOU LOOKING FOR? --}}'

start_idx = content.find(matching_treks_start)
end_idx = content.find(matching_treks_end)
if start_idx != -1 and end_idx != -1:
    content = content[:start_idx] + content[end_idx:]

# 2. Add an "Explore Treks" button to the discovery section so users can submit their season/difficulty selections to the listing page.
# Wait, in old_home.blade.php, it's an Alpine form `x-data="trekDiscovery()"`.
# I'll change the Alpine logic to redirect instead of filtering inline.
alpine_script_start = '<script>\n    document.addEventListener(\'alpine:init\', () => {\n        Alpine.data(\'trekDiscovery\', () => ({'
new_alpine_script = '''
        <div class="mt-12 flex justify-center">
            <button @click="window.location.href = '{{ route('treks.index') }}?month=' + (activeMonth || '') + '&season=' + (activeSeason || '') + '&difficulty=' + (activeDifficulty || '')" 
                class="inline-flex items-center justify-center font-bold text-sm tracking-[0.2em] uppercase px-12 py-5 bg-brand-primary text-white hover:bg-brand-secondary transition-colors focus:outline-none rounded-sm">
                Explore Treks
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('trekDiscovery', () => ({
'''

content = content.replace('    </div>\n</div>\n\n<script>\n    document.addEventListener(\'alpine:init\', () => {\n        Alpine.data(\'trekDiscovery\', () => ({', new_alpine_script)

# Also remove the `treks: @json($allTreks),` and `filteredTreks` logic from the script to make it clean since we don't filter inline anymore.
# Let's replace the whole script tag.
script_regex = re.compile(r'<script>\s*document\.addEventListener\(\'alpine:init\', \(\) => \{\s*Alpine\.data\(\'trekDiscovery\'.*?</script>', re.DOTALL)

clean_script = """<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('trekDiscovery', () => ({
            activeMonth: null,
            activeSeason: null,
            activeDifficulty: null,
            
            toggleMonth(month) {
                this.activeMonth = this.activeMonth === month ? null : month;
            },
            
            toggleSeason(season) {
                this.activeSeason = this.activeSeason === season ? null : season;
            },
            
            toggleDifficulty(difficulty) {
                this.activeDifficulty = this.activeDifficulty === difficulty ? null : difficulty;
            },
            
            clearFilters() {
                this.activeMonth = null;
                this.activeSeason = null;
                this.activeDifficulty = null;
            }
        }));
    });
</script>"""

content = script_regex.sub(clean_script, content)

with open(new_home_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Rollback applied successfully")
