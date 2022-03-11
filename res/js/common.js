function execDaumPostcode(zip, road, jibun) {
	new daum.Postcode({
		shorthand : false,
		oncomplete: function(data) {
        	var roadAddr = ''; // 최종 주소 변수
          	var extraAddr = ''; // 조합형 주소 변수
          	var newAddr = data.roadAddress;

          	roadAddr = data.roadAddress;
          	if(data.bname !== ''){
            	extraAddr += data.bname;
          	}
              // 건물명이 있을 경우 추가한다.
          	if(data.buildingName !== ''){
            	extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
          	}
              // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
          	roadAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			$(zip).val(data.zonecode);
			$(jibun).val((data.jibunAddress !== '' ? data.jibunAddress : data.autoJibunAddress));
			$(road).val(roadAddr);
			
		}
	}).open({popupName: 'cleand_popup', });
}

function execDaumPostcode2(zip, road, jibun, callback) {
	new daum.Postcode({
		shorthand : false,
		oncomplete: function(data) {
        	var roadAddr = ''; // 최종 주소 변수
          	var extraAddr = ''; // 조합형 주소 변수
          	var newAddr = data.roadAddress;

          	roadAddr = data.roadAddress;
          	if(data.bname !== ''){
            	extraAddr += data.bname;
          	}
              // 건물명이 있을 경우 추가한다.
          	if(data.buildingName !== ''){
            	extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
          	}
              // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
          	roadAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			$(zip).val(data.zonecode);
			$(jibun).val((data.jibunAddress !== '' ? data.jibunAddress : data.autoJibunAddress));
			$(road).val(roadAddr);
			
			callback();
		}
	}).open({popupName: 'cleand_popup', });
}

function commify(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function showAlert(icon, msg, callback, msg2) {
	callback = typeof callback != 'undefined' ? callback : null;
	msg2 = typeof msg2 != 'undefined' ? msg2 : '';
	
	Swal.fire({ 
		icon: icon, // Alert 타입 
		title: msg, // Alert 제목 
		html: msg2, // Alert 내용 
		confirmButtonColor: '#003ca6',
		confirmButtonText : '확인',
		allowOutsideClick: false,
	}).then(function(result) { 
   		if(callback !== null) callback(); 
    });

	if(msg2 == '') {
		$('.swal2-header #swal2-title').css('font-weight', '400');
		$('.swal2-content #swal2-content').css('margin', '0');
	}
	else {
		$('.swal2-header #swal2-title').css('font-weight', '700');	
	}
}

function showConfirm(data, confirm, cancel) {
	cancel = typeof cancel != 'undefined' ? cancel : null;
	data.msg2 = typeof data.msg2 != 'undefined' ? data.msg2 : '';
	
	Swal.fire({
        title: data.msg,
        html: data.msg2,
        icon: "warning",
        showCancelButton: true,
        allowOutsideClick: false,
        cancelButtonColor: '#003ca6',
        cancelButtonText: data.cancel,
        confirmButtonColor: '#003ca6',
        confirmButtonText: data.confirm,
		reverseButtons: true,
    }).then(function(result) { 
    	if (result.isConfirmed) {
    		if(confirm !== null) confirm(); 
    	}
    	else {
    		if(cancel !== null) cancel();
    	}
    });

	if(data.msg2 == '') {
		$('.swal2-header #swal2-title').css('font-weight', '400');
		$('.swal2-content #swal2-content').css('margin', '0');
	}
	else {
		$('.swal2-header #swal2-title').css('font-weight', '700');	
	}
}

function showDelete(msg, confirm, cancel) {
	cancel = typeof cancel != 'undefined' ? cancel : null;

	Swal.fire({
        title: "",
        text: msg,
        icon: "warning",
        showCancelButton: true,
        allowOutsideClick: false,
        cancelButtonText: '취소',
        confirmButtonColor: '#ed5565',
        confirmButtonText: '삭제',
    }).then(function(result) { 
    	if (result.isConfirmed) {
    		if(confirm !== null) confirm(); 
    	}
    	else {
    		if(cancel !== null) cancel();
    	}
    });
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function isMobile(){
	var UserAgent = navigator.userAgent;
	if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null)
	{
		return true;
	}
	else{
		return false;
	}
}

$(document).on("input", "input[type=text].onlyNumber", function (event) {
    var $this = $(this);
    var num = $this.val().replace(/[,]/g, "");

    var parts = num.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $this.val(parts.join("."));
});

function dateDiff(_date1, _date2) {
    var diff = Math.abs(_date2.getTime() - _date1.getTime());
    diff = Math.ceil(diff / (1000 * 3600 * 24));
 
    return diff;
}

