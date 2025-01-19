// ! 這部分是拿所有填入的資料
var frequency = function() {
    var v;
    $('[name="frequency"]').each(function() {
      if($(this).prop('checked') === true) v = $(this).val();
    });
    return v;
  };
  var sex = function() {
    var v;
    $('[name="sex"]').each(function() {
      if($(this).prop('checked') === true) v = $(this).val();
    });
    return v;
  };

  var age = function() {
    var v;
    $('[name="age"]').each(function() {
      if($(this).prop('checked') === true) v = $(this).val();
    });
    return v;
  };



  var Whyfrequency1 = function() {
    var v;
    $('[name="Whyfrequency1"]').each(function() {
        if($(this).prop('checked') === true) v = $(this).val();
      });
      return v;
    };

// ! 各表單內容按鈕區    
    $('#OneBt').click(function(){
        $('#one').toggle();
        $('#two').toggle();
    });

    $('#TwoResBt').click(function(){
        $('#one').toggle();
        $('#two').toggle();
    });

    $('#TwoBt').click(function(){
        $('#two').toggle();
        $('#three').toggle();
    });
    
    $('#ThreeResBt').click(function(){
        $('#two').toggle();
        $('#three').toggle();
    });

    $('#ThreeoBt').click(function(){
        console.log(frequency());
        if(frequency()=='沒使用過' || frequency()=='很少使用（有需要才會用）'){
            $('#three').toggle();
            $('#four').toggle();

        }else{
          $('#three').toggle();
          $('#five').toggle();
        }
    });


// ! 新增至GooG表單的部分
$(function() {
    //這裡的#check要改成之後要的按鈕
  $('#check').on('click', function() {
    
    var data={
        'entry.301849957' :sex(),       //年齡
        'entry.2085011906' :age(),      //性別
        'entry.1915161455' :frequency(),//販賣機使用頻率
        'entry.912286954' :Whyfrequency1(),
        'entry.891220809' :sex(),
        'entry.1081131290' :sex(),
        'entry.1373562174' :sex(),
        'entry.1603727985' :sex(),
        'entry.2084903782' :sex(),
        'entry.205516134' :sex(),
        'entry.265106250' :sex(),
        'entry.318337737' :sex(),
        'entry.474723210' :sex(),
        'entry.542883034' :sex(),
        'entry.270837041' :sex(),
        'entry.839891953' :sex()
    }


    $.ajax({
        type: 'POST',
        url: 'https://docs.google.com/forms/u/4/d/e/1FAIpQLSeNTJrHdRZeNyMdskzVtLMgCrW3V7a4Khrew5cUvNfZNxhxQg/formResponse',
        data: data,
        contentType: 'application/json',
        dataType: 'jsonp',
        complete: function() {
            alert('資料已送出！');
        }
    });

  });
});