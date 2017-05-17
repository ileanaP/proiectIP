<div>
    <p class="lead">Mai multe opinii despre eveniment:</p>
    <div class="list-group">
        <table class="table" style="border-top: 1px solid #cdd0d4">
        @foreach($feedback as $userFeedback)
            <tr style="border-left: 1px solid #cdd0d4;border-right: 1px solid #cdd0d4;width:70%">
              <td> <h4 align="left"> {{ $userFeedback->user }}: </h4>
                  @if ($userFeedback->stars == 1) &#x2605;</span>
                  @elseif ($userFeedback->stars ==2) &#x2605;&#x2605;
                  @elseif ($userFeedback->stars == 3) &#x2605;&#x2605;&#x2605;
                  @elseif ($userFeedback->stars == 4) &#x2605;&#x2605;&#x2605;&#x2605;
                  @elseif ($userFeedback->stars == 5) &#x2605;&#x2605;&#x2605;&#x2605;&#x2605;
                  @endif

              </td>
                <td align="right">{{ $userFeedback->created_at }}
                <br></td>
            </tr>
            <tr style="border-left: 1px solid #cdd0d4;border-bottom: 1px solid #cdd0d4; border-right: 1px solid #cdd0d4" >
                <td colspan="2"> {{ $userFeedback->comm }}
                </td>
            </tr>
        @endforeach
        </table>
    </div>
</div>