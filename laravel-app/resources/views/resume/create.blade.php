<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a Resume') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form id="resumeForm" action="{{ route('resume.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Step 1 -->
                    <div class="step" id="step1">
                        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Personal Information</h3>
                        <input type="text" name="name" placeholder="Full Name" class="block w-full mb-4 p-2 rounded dark:bg-gray-700 dark:text-white">
                        <input type="email" name="email" placeholder="Email" class="block w-full mb-4 p-2 rounded dark:bg-gray-700 dark:text-white">
                        <input type="text" name="phone" placeholder="Phone" class="block w-full p-2 rounded dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Step 2 -->
                    <div class="step hidden" id="step2">
                        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Education</h3>
                        <textarea name="education" rows="4" placeholder="Your Education Details" class="block w-full p-2 rounded dark:bg-gray-700 dark:text-white"></textarea>
                    </div>

                    <!-- Step 3 -->
                    <div class="step hidden" id="step3">
                        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Experience</h3>
                        <textarea name="experience" rows="4" placeholder="Your Work Experience" class="block w-full p-2 rounded dark:bg-gray-700 dark:text-white"></textarea>
                    </div>

                    <!-- Step 4 -->
                    <div class="step hidden" id="step4">
                        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Skills</h3>
                        <textarea name="skills" rows="4" placeholder="Your Skills" class="block w-full p-2 rounded dark:bg-gray-700 dark:text-white"></textarea>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="bg-gray-400 px-4 py-2 rounded text-white">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="bg-blue-600 px-4 py-2 rounded text-white">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 0;
        showStep(currentStep);

        function showStep(n) {
            let steps = document.getElementsByClassName("step");
            steps[n].classList.remove("hidden");
            if (n === 0) document.getElementById("prevBtn").style.display = "none";
            else document.getElementById("prevBtn").style.display = "inline-block";

            if (n === (steps.length - 1)) document.getElementById("nextBtn").innerHTML = "Submit";
            else document.getElementById("nextBtn").innerHTML = "Next";
        }

        function nextPrev(n) {
            let steps = document.getElementsByClassName("step");
            steps[currentStep].classList.add("hidden");
            currentStep += n;
            if (currentStep >= steps.length) {
                document.getElementById("resumeForm").submit();
                return false;
            }
            showStep(currentStep);
        }
    </script>
</x-app-layout>
