<div class="list-card">
  <div class="listcard-header schedules clearfix">
    Schedules
    @can('create-task', $project)
    <a href="{{ route('projects#scheduleCreateView', [$project->id]) }}" class="float-right"><i class="fas fa-plus"></i></a>
    @endcan
  </div>
  <table class="table" id="schedules">
    <thead>
      <tr>
        <th class="header-cell" scope="col">Name</th>
        <th class="header-cell" scope="col">Deadline Date</th>
        <th class="header-cell" scope="col">Status</th>
        <th class="header-cell" scope="col">Assignor</th>
        <th class="header-cell" scope="col">Assignee</th>
        <th class="header-cell" scope="col">Operation</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($project->schedules as $schedule)
      <tr>
        <td>{{ $schedule->name }}</td>
        <td>{{ \Carbon\Carbon::parse($schedule->end_date )->toDateString() }}</td>
        <td>{{ $schedule->status_text }}</td>
        <td>{{ $schedule->assignor->name }}</td>
        <td>{{ $schedule->assignee->name }}</td>
        <td>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
