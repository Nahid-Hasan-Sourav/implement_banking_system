{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('frontend.master')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

    <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">USER <span class="tx-info tx-normal">SIGNIN</span></div>
      <div class="tx-center mg-b-60">wellcome</div>
      <form method="POST" action="">
      @csrf
   
      <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Enter your name">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

      </div><!-- form-group -->
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Enter your email">
        @error('  email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div><!-- form-group -->
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Enter your password">
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div><!-- form-group -->
      <div class="form-group">
        <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Select Account Type</label>
        <div class="row row-xs">
       
          <div class="col-sm-12">
            <select class="form-control select2" name="role" data-placeholder="Month">
              <option value="Individual">Indivdual</option>
              <option value="Business">Business</option>
            </select>
          </div>
         
        </div><!-- row -->
      </div><!-- form-group -->
      <div class="form-group tx-12">By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.</div>
      <button type="submit" class="btn btn-info btn-block">Sign Up</button>
         
      <div class="mg-t-40 tx-center">Already have an account? <a href="{{ route(login) }}" class="tx-info">Sign In</a></div>
    </form>
    </div><!-- login-wrapper -->
  </div>
@endsection