import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Task } from './models/task';
import { TaskService } from './services/task.service';

@Component({
  selector: 'app-root',
  imports: [CommonModule, FormsModule],
  templateUrl: './app.component.html',
})
export class AppComponent implements OnInit {
  tasks: Task[] = [];
  newTitle = '';
  editingId: number | null = null;
  editTitle = '';
  error = '';

  constructor(private taskService: TaskService) {}

  ngOnInit(): void {
    this.loadTasks();
  }

  loadTasks(): void {
    this.taskService.getTasks().subscribe({
      next: (tasks) => {
        this.tasks = tasks;
        this.error = '';
      },
      error: () => (this.error = 'Could not load tasks'),
    });
  }

  addTask(): void {
    const title = this.newTitle.trim();
    if (!title) {
      return;
    }

    this.taskService.createTask(title).subscribe({
      next: (task) => {
        this.tasks = [task, ...this.tasks];
        this.newTitle = '';
        this.error = '';
      },
      error: () => (this.error = 'Could not add task'),
    });
  }

  startEdit(task: Task): void {
    this.editingId = task.id;
    this.editTitle = task.title;
  }

  cancelEdit(): void {
    this.editingId = null;
    this.editTitle = '';
  }

  saveEdit(): void {
    if (this.editingId === null) {
      return;
    }

    const title = this.editTitle.trim();
    if (!title) {
      return;
    }

    this.taskService.updateTask(this.editingId, title).subscribe({
      next: (updated) => {
        this.tasks = this.tasks.map((task) =>
          task.id === updated.id ? updated : task,
        );
        this.cancelEdit();
        this.error = '';
      },
      error: () => (this.error = 'Could not update task'),
    });
  }

  removeTask(id: number): void {
    this.taskService.deleteTask(id).subscribe({
      next: () => {
        this.tasks = this.tasks.filter((task) => task.id !== id);
        if (this.editingId === id) {
          this.cancelEdit();
        }
        this.error = '';
      },
      error: () => (this.error = 'Could not delete task'),
    });
  }
}
