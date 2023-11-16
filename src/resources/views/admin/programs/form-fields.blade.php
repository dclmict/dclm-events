<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group mb-2">
            <label class="fw-bold">Event Name:</label>
            <input type="text" name="name" value="{{ $formMode == 'edit' ? $program->name : old('name') }}" class="form-control" placeholder="The Power that Never Fails">
        </div>

        <div class="form-group mb-2">
            <label class="fw-bold">Banner Image: {{ $formMode == 'edit' ? $program->image_location : old('image_location') }}</label>
            <input type="file" name="image" accept="image/jpeg, image/png, image/jpg, image/gif, image/svg" class="form-control" placeholder="Event FLyer 1920px x 1080px">
        </div>

        {{-- <div class="form-group mb-2">
            <label class="fw-bold">Event Category:</label>
            <input type="text" name="category" value="{{ $formMode == 'edit' ? $program->category : old('category') }}" class="form-control" placeholder="GCK: November Edition">
        </div> --}}

        @php($selectEventCat = ($formMode == 'edit') ? $program->category : old('category')  )
        <div class="form-group mb-2">
            <label class="fw-bold" for="category">Event type:</label>
            <select class="form-control" id="category" name="category">
                <option> --Select Event Category--</option>
                @forelse ($event_category as $ec )
                    <option value="{{$ec->option_value}}" @if ($selectEventCat == $ec->option_value ) selected @endif>{{$ec->option_value}}</option>
                @empty
                    <option value=""  selected >No Event Category</option>
                @endforelse
            </select>
        </div>

        @php($selectEventType = ($formMode == 'edit') ? $program->event_type : old('event_type')  )
        <div class="form-group mb-2">
            <label class="fw-bold" for="category">Event type:</label>
            <select class="form-control" id="category" name="event_type">
                <option> --Select Event Type--</option>
                @forelse ($event_type as $et )
                    <option value="{{$et->option_value}}" @if ($selectEventType == $et->option_value ) selected @endif>{{$et->option_value}}</option>
                @empty
                    <option value=""  selected >No Event Category</option>
                @endforelse
            </select>
        </div>

        <div class="form-group mb-2">
            <label class="fw-bold">Event Date: <em>(format: JAN, 17th - 20th, 2022)</em></label>
            <input type="text" name="date" value="{{ $formMode == 'edit' ? $program->event_date : old('event_date') ?? '' }}" class="form-control" placeholder="JAN, 17 - 20th, 2022">
        </div>

        @php($selectMonth = ($formMode == 'edit') ? $program->event_month : old('event_month')  )
        <div class="form-group mb-2">
            <label class="fw-bold" for="event_month">Event Month:</label>
            <select class="form-control" id="event_month" name="event_month">
                <option value="January" @if ($selectMonth == 'January') selected @endif>January</option>
                <option value="February" @if ($selectMonth == 'February') selected @endif>February</option>
                <option value="March" @if ($selectMonth == 'March') selected @endif>March</option>
                <option value="April" @if ($selectMonth == 'April') selected @endif>April</option>
                <option value="May" @if ($selectMonth == 'May') selected @endif>May</option>
                <option value="June" @if ($selectMonth == 'June') selected @endif>June</option>
                <option value="July" @if ($selectMonth == 'July') selected @endif>July</option>
                <option value="August" @if ($selectMonth == 'August') selected @endif>August</option>
                <option value="September" @if ($selectMonth == 'September') selected @endif>September</option>
                <option value="October" @if ($selectMonth == 'October') selected @endif>October</option>
                <option value="November" @if ($selectMonth == 'November') selected @endif>November</option>
                <option value="December" @if ($selectMonth == 'December') selected @endif>December</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label class="fw-bold">Event Countdown:</label>
            <input type="text" name="countdown" value="{{ $formMode == 'edit' ? $program->event_countdown : old('event_countdown') }}" class="form-control" placeholder="2022/11/17">
        </div>

        <div class="form-group mb-2">
            <label class="fw-bold" for="event_days">Event Days:</label>
            <input type="text" value="{{ $formMode == 'edit' ? $program->event_days : old('event_days') }}"  class="form-control" id="event_days" name="event_days" placeholder="Enter event days (ex: 21, 22, 23, 24, 25, etc)">
        </div>

    </div>

    <div class="col-12 col-sm-6">

        {{-- @dump($schedules) --}}
        <div class="schedules">
            <table class="table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Event</th>
                        <th>Speaker</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="fieldTable">
                    @if ($formMode == 'edit')
                        @php($schedules = json_decode($program->schedules))
                        @foreach ($schedules as  $s)
                        <tr>
                            <td><input type="time"  value="{{ $s->time ?? '' }}" class="form-control form-control-s," name="time[]" placeholder="Time" required></td>
                            <td><input type="text"  value="{{ $s->event ?? '' }}" class="form-control form-control-s," name="event[]" placeholder="Event" required></td>
                            <td><input type="text"  value="{{ $s->speaker ?? '' }}" class="form-control form-control-s," name="speaker[]" placeholder="Speaker"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove">X</button></td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td><input type="time" class="form-control form-control-s," name="time[]" placeholder="Time" required></td>
                        <td><input type="text" class="form-control form-control-s," name="event[]" placeholder="Event" required></td>
                        <td><input type="text" class="form-control form-control-s," name="speaker[]" placeholder="Speaker"></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove">X</button></td>
                    </tr>
                    @endif

                </tbody>
            </table>
            <button type="button" id="addField" class="btn btn-primary">Add Event Schedule</button>
        </div>


    </div>
    <div class="col-xs-12 my-2 col-sm-12 col-md-7 mx-auto">
        <button type="submit" class="btn btn-primary  btn-lg">Submit</button>
    </div>
</div>
