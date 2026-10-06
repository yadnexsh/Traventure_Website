@props(['currentStep' => 1])

<div class="mb-12">
    <div class="hidden sm:block">
        <nav aria-label="Progress">
            <ol role="list" class="flex items-center justify-between w-full">
                @php
                    $steps = [
                        1 => 'Details',
                        2 => 'Trekmates',
                        3 => 'Add-ons',
                        4 => 'Review',
                        5 => 'Payment'
                    ];
                @endphp
                @foreach($steps as $stepNum => $stepName)
                    <li class="relative flex-1 {{ $loop->last ? '' : 'pr-8 sm:pr-20' }}">
                        @if($stepNum < $currentStep)
                            @if(!$loop->last)
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="h-0.5 w-full bg-brand-primary"></div>
                            </div>
                            @endif
                            <span class="relative flex h-8 w-8 items-center justify-center rounded-full bg-brand-primary">
                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">{{ $stepName }} (Completed)</span>
                            </span>
                        @elseif($stepNum == $currentStep)
                            @if(!$loop->last)
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="h-0.5 w-full bg-border-subtle"></div>
                            </div>
                            @endif
                            <span class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 border-brand-primary bg-white" aria-current="step">
                                <span class="h-2.5 w-2.5 rounded-full bg-brand-primary"></span>
                                <span class="sr-only">{{ $stepName }} (Current)</span>
                            </span>
                        @else
                            @if(!$loop->last)
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="h-0.5 w-full bg-border-subtle"></div>
                            </div>
                            @endif
                            <span class="relative flex h-8 w-8 items-center justify-center rounded-full border-2 border-border-subtle bg-white">
                                <span class="sr-only">{{ $stepName }} (Upcoming)</span>
                            </span>
                        @endif
                        <span class="absolute -bottom-6 left-0 text-xs font-medium {{ $stepNum <= $currentStep ? 'text-brand-primary' : 'text-text-muted' }}">{{ $stepName }}</span>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
    <div class="sm:hidden flex flex-col items-center justify-center">
        <p class="text-sm font-medium text-text-primary mb-2">Step {{ $currentStep }} of 5</p>
        <div class="w-full bg-border-subtle rounded-full h-2">
            <div class="bg-brand-primary h-2 rounded-full" style="width: {{ ($currentStep / 5) * 100 }}%"></div>
        </div>
    </div>
</div>
