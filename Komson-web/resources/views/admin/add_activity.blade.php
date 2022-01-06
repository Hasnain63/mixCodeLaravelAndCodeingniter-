<div class="form-group">
    <label for="activity" class="control-label mb-1"> Activity</label>
    @if(!empty($getActivity))
    @foreach($getActivity as $atc)
    <input id="activity" name="activity" type="text" value="{{$atc->activity}}" readonly class="form-control">
    @endforeach
    @endif
</div>