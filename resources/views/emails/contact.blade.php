@component('mail::message')
# New Contact Form Submission

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Phone:** {{ $data['phone'] }}  

---

### Message:
{{ $data['message'] }}

@endcomponent
