@php
    $statusConfig = [
        'pending'   => ['class' => 'bg-warning text-dark', 'label' => '未完了'],
        'completed' => ['class' => 'bg-success', 'label' => '完了'],
    ];
    $priorityConfig = [
        'high'   => ['class' => 'bg-danger', 'label' => '高'],
        'medium' => ['class' => 'bg-warning text-dark', 'label' => '中'],
        'low'    => ['class' => 'bg-secondary', 'label' => '低'],
    ];
@endphp
<span class="badge {{ $statusConfig[$todo->status]['class'] }}">
    {{ $statusConfig[$todo->status]['label'] }}
</span>
<span class="badge {{ $priorityConfig[$todo->priority]['class'] }}">
    優先度: {{ $priorityConfig[$todo->priority]['label'] }}
</span>
