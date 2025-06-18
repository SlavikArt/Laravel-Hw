<div class="task-manager">
    <div class="task-container">
        <h2 class="task-title">📋 Список завдань</h2>
        
        <div class="add-task-form">
            <input 
                type="text" 
                wire:model="name" 
                placeholder="Введіть нове завдання..." 
                class="task-input"
                wire:keydown.enter="createTask"
            >
            <button wire:click="createTask" class="add-button">
                <span>+</span>
            </button>
        </div>

        <div class="tasks-list">
            @if($tasks->count() > 0)
                @foreach($tasks as $task)
                    <div class="task-item {{ $task->completed ? 'completed' : '' }}">
                        <div class="task-content">
                            <label class="checkbox-container">
                                <input 
                                    type="checkbox" 
                                    wire:click="toggleComplete({{ $task->id }})" 
                                    @if($task->completed) checked @endif
                                    class="task-checkbox"
                                >
                                <span class="checkmark"></span>
                            </label>
                            <span class="task-text">{{ $task->name }}</span>
                        </div>
                        <button 
                            wire:click="deleteTask({{ $task->id }})" 
                            class="delete-button"
                            title="Видалити завдання"
                        >
                            🗑️
                        </button>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">📝</div>
                    <p>Немає завдань</p>
                    <small>Додайте перше завдання вище</small>
                </div>
            @endif
        </div>

        @if($tasks->count() > 0)
            <div class="task-stats">
                <span>Всього: {{ $tasks->count() }}</span>
                <span>Виконано: {{ $tasks->where('completed', true)->count() }}</span>
            </div>
        @endif
    </div>

    <style>
        .task-manager {
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .task-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .task-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .add-task-form {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .task-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            color: #000;
        }

        .task-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .add-button {
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(238, 90, 36, 0.4);
        }

        .tasks-list {
            margin-bottom: 1.5rem;
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            margin-bottom: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: slideIn 0.3s ease;
        }

        .task-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .task-item.completed {
            background: rgba(76, 175, 80, 0.2);
            border-color: rgba(76, 175, 80, 0.3);
        }

        .task-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .checkbox-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .task-checkbox {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            height: 24px;
            width: 24px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .task-checkbox:checked ~ .checkmark {
            background: #4caf50;
            border-color: #4caf50;
        }

        .task-checkbox:checked ~ .checkmark::after {
            content: '✓';
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .task-text {
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .task-item.completed .task-text {
            text-decoration: line-through;
            opacity: 0.7;
        }

        .delete-button {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .delete-button:hover {
            opacity: 1;
            background: rgba(244, 67, 54, 0.2);
            transform: scale(1.1);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            opacity: 0.8;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .empty-state p {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state small {
            opacity: 0.8;
        }

        .task-stats {
            display: flex;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .task-manager {
                margin: 1rem auto;
            }
            
            .task-container {
                padding: 1.5rem;
                border-radius: 15px;
            }
            
            .task-title {
                font-size: 1.5rem;
            }
            
            .add-task-form {
                flex-direction: column;
            }
            
            .add-button {
                width: 100%;
                height: 45px;
            }
        }
    </style>
</div>
