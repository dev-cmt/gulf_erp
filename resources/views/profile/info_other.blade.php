
    <form action="{{ route('info_other.update', $infoOther->id )}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Description</label>
                <textarea name="about_me" class="form-control @error('about_me') is-invalid @enderror" rows="4" id="comment" placeholder="What would you like to see?">{{$infoOther->about_me}}</textarea>
                @error('about_me')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Facebook Link</label>
            <div class="input-group mb-3  input-success">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                </div>
                <input type="text" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="https://www.facebook.com" value="{{$infoOther->facebook_url}}">
                @error('facebook_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Youtube Link</label>
            <div class="input-group mb-3  input-success">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                </div>
                <input type="text" name="youtube_url" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="https://www.youtube.com" value="{{$infoOther->youtube_url}}">
                @error('youtube_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Twitter Link</label>
            <div class="input-group mb-3  input-success">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                </div>
                <input type="text" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" placeholder="https://twitter.com" value="{{$infoOther->twitter_url}}">
                @error('twitter_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Instagram Link</label>
            <div class="input-group mb-3  input-success">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                </div>
                <input type="text" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" placeholder="https://www.instagram.com" value="{{$infoOther->instagram_url}}">
                @error('instagram_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Linkedin Link</label>
            <div class="input-group mb-3  input-success">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-linkedin"></i></span>
                </div>
                <input type="text" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" placeholder="https://www.linkedin.com" value="{{$infoOther->linkedin_url}}">
                @error('linkedin_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
            
        <div class="form-group">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary ">Update</button>
            </div>
        </div>
    </form>