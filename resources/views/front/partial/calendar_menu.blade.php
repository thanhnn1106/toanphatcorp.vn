<?php
    $inputDate   = isset($inputDate) ? $inputDate : date('Y-m');

    $currentDate = formatMonthYear(date('Y-m-d'));
    if ( ! empty($inputDate)) {
        $currentDate = formatMonthYear($inputDate);
    }

    $dateSel  = array();
    $search   = array('search_date' => $inputDate);
    $fileInfo = App\Models\FilesInfo::search($search, false);
    $fileInfo->map(function ($item) use (& $dateSel) {
        $date = date('Y-m-d', strtotime($item->created_at));
        $dateSel[$date] = $date;
    });

    $days         = array(
        'Monday'       => 'M',
        'Tuesday'      => 'T',
        'Wednesday'    => 'W',
        'Thursday'     => 'T',
        'Friday'       => 'F',
        'Saturday'     => 'S',
        'Sunday'       => 'S',
    );

    $start     = new DateTime(date('Y', strtotime($inputDate)) . '-' .  date('m', strtotime($inputDate)). '-01');
    $startday  = (int) $start->format('N');
    $monthdays = (int) $start->format('t');
    $rows      = ($monthdays + $startday)/7;
    $yearMonth = $start->format('Y-m');

    $modifyPre      = $start->modify('-1 month');
    $preMonthLabel  = $modifyPre->format('M');
    $preYearMonth   = $modifyPre->format('Y-m');

    $modifyNext     = $start->modify('+2 month');
    $nextMonthLabel = $modifyNext->format('M');
    $nextMonth      = $modifyNext->format('Y-m');
?>
<dl>
    <dd>
        <div class="month">
            <ul>
                <li class="prev">
                    <a href="{{ route('front.calendar_detail', ['date' => $preYearMonth]) }}">&#10094;</a>
                </li>
                @if($yearMonth < date('Y-m'))
                <li class="next">
                    <a href="{{ route('front.calendar_detail', ['date' => date('Y-m')]) }}">&#10095;</a>
                </li>
                @else
                <li class="next">&#10095;</li>
                @endif
                <li> {{ $currentDate }} </li>
            </ul>
        </div>
        <ul class="weekdays">
            <li>Mo</li>
            <li>Tu</li>
            <li>We</li>
            <li>Th</li>
            <li>Fr</li>
            <li>Sa</li>
            <li>Su</li>
        </ul>
        <ul class="days">
            <?php for ($i = 0; $i < $startday - 1; $i++) { ?>
                <li></li>
            <?php } ?>
            <?php for ($i = 1; $i <= $monthdays; $i++) { ?>
                <?php $dateLabel = $yearMonth . '-' . str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                @if(isset($dateSel[$dateLabel]))
                <li>
                    <span class="active">
                        <a href="{{ route('front.calendar_detail', ['date' => $dateLabel]) }}">{{ $i }}</a>
                    </span>
                </li>
                @else
                <li>{{ $i }}</li>
                @endif
            <?php } ?>
        </ul>
    </dd>
</dl>
@if (count($popularTags) > 0)
<dl class="frm_cate most_popular">
    <dt>Most popular</dt>
    <dd>
        <ul class="clearfix">
            @foreach ($popularTags as $item)
            <li><a href="{{ route('front.tag_detail', ['slug' => $item->slug]) }}" class="size_0{{ rand(1,9) }}">{{ $item->name }}</a></li>
            @endforeach
        </ul>
    </dd>
</dl>
@endif
