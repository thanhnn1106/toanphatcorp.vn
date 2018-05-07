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
<dl class="frm_cate">
    <dt>Calendar</dt>
    <dd>
        <table>
            <caption>{{ $currentDate }}</caption>
            <thead>
                <tr>
                    @foreach($days as $keyD => $day)
                    <th scope="col" title="{{ $keyD }}">{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tfoot>
                <tr>
                  <td colspan="3"><a href="{{ route('front.calendar_detail', ['date' => $preYearMonth]) }}">« {{ $preMonthLabel }}</a></td>
                    <td>&nbsp;</td>
                    <td colspan="3">
                        @if($yearMonth < date('Y-m'))
                        <a href="{{ route('front.calendar_detail', ['date' => date('Y-m')]) }}">{{ $nextMonthLabel }} »</a>
                        @else
                        &nbsp;
                        @endif
                    </td>
                </tr>
            </tfoot>
            <tbody>
                @for($i = 0; $i < $rows; $i++)
                <tr>
                    @for($j = 1; $j <= 7; $j++)
                        <?php $day = 7 * $i + $j - $startday + 1; ?>
                        @if ($day <= 0 || $day > $monthdays)
                        <td>&nbsp;</td>
                        @else
                        <?php $dateLabel = $yearMonth.'-'.str_pad($day, 2, '0', STR_PAD_LEFT); ?>
                            @if(isset($dateSel[$dateLabel]))
                            <td><a href="{{ route('front.calendar_detail', ['date' => $dateLabel]) }}" style="font-weight: bold;">{{ $day }}</a></td>
                            @else
                            <td>{{ $day }}</td>
                            @endif
                        @endif
                    @endfor
                </tr>
                @endfor
            </tbody>
        </table>
    </dd>
</dl>