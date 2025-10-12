<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bcrypt Password Generator - Klinik</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            
            <!-- Header -->
            <div class="bg-white shadow-lg rounded-xl p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">🔐 Bcrypt Password Generator</h1>
                <p class="text-gray-600">Generate secure bcrypt hash untuk password Laravel</p>
            </div>

            <!-- Generator Form -->
            <div class="bg-white shadow-lg rounded-xl p-8">
                <form id="bcryptForm" class="space-y-6" action="{{ url('/bcrypt') }}" method="POST">
                    @csrf
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password yang akan di-hash:
                        </label>
                        <input type="text" 
                               id="password" 
                               name="password"
                               placeholder="Masukkan password..."
                               value="{{ old('password') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors">
                    </div>

                    <div>
                        <label for="rounds" class="block text-sm font-medium text-gray-700 mb-2">
                            Rounds (Cost Factor):
                        </label>
                        <select id="rounds" 
                                name="rounds"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors">
                            <option value="8">8 (Development)</option>
                            <option value="10" selected>10 (Default - Recommended)</option>
                            <option value="12">12 (High Security for Clinic)</option>
                            <option value="14">14 (Maximum Security)</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Semakin tinggi rounds, semakin secure tapi semakin lambat</p>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        🚀 Generate Bcrypt Hash (Server-side)
                    </button>
                </form>

                <!-- Result Section -->
                <div id="resultSection" class="mt-8 {{ isset($hash) ? '' : 'hidden' }}">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">📋 Generated Hash:</h3>
                    
                    <div class="bg-gray-50 border rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-sm font-medium text-gray-700">Bcrypt Hash:</label>
                            <button onclick="copyToClipboard('hashResult')" 
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                📋 Copy
                            </button>
                        </div>
                        <textarea id="hashResult" 
                                  readonly 
                                  class="w-full h-24 p-3 bg-white border rounded font-mono text-sm resize-none"
                                  placeholder="Hash akan muncul di sini...">{{ $hash ?? '' }}</textarea>
                    </div>

                    @if(isset($hash))
                    <!-- Verification Test -->
                    <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-800 mb-2">✅ Hash Berhasil Dibuat!</h4>
                        <div class="space-y-2 text-sm">
                            <div>
                                <strong>Password:</strong> <code>{{ $original_password }}</code>
                            </div>
                            <div>
                                <strong>Cost:</strong> {{ $cost ?? 10 }}
                            </div>
                            <div>
                                <strong>Hash Length:</strong> {{ strlen($hash) }} characters
                            </div>
                            <div>
                                <strong>Algorithm:</strong> {{ password_get_info($hash)['algoName'] ?? 'bcrypt' }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Laravel Usage -->
                    <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-800 mb-2">💡 Cara Penggunaan di Laravel:</h4>
                        <div class="space-y-2 text-sm">
                            <div>
                                <strong>Database Update:</strong>
                                <code class="block bg-white p-2 rounded border text-xs mt-1 font-mono">
UPDATE users SET password = '<span id="hashForLaravel">{{ $hash ?? '$2y$10$...' }}</span>' WHERE email = 'user@example.com';
                                </code>
                            </div>
                            <div>
                                <strong>Laravel Hash::make():</strong>
                                <code class="block bg-white p-2 rounded border text-xs mt-1 font-mono">
Hash::make('{{ $original_password ?? 'your_password' }}')
                                </code>
                            </div>
                            <div>
                                <strong>Verify Password:</strong>
                                <code class="block bg-white p-2 rounded border text-xs mt-1 font-mono">
Hash::check('{{ $original_password ?? 'plaintext_password' }}', $hashedPassword)
                                </code>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-semibold text-yellow-800 mb-2">ℹ️ Informasi Penting:</h4>
                    <ul class="text-sm text-yellow-700 space-y-1">
                        <li>• Generator ini menggunakan PHP bcrypt asli (server-side)</li>
                        <li>• Hash yang dihasilkan 100% kompatibel dengan Laravel Auth</li>
                        <li>• Setiap generate akan menghasilkan hash yang berbeda (karena salt random)</li>
                        <li>• Hash yang sama dapat diverifikasi dengan <code>Hash::check()</code></li>
                        <li>• Untuk klinik, disarankan menggunakan cost 12 untuk keamanan ekstra</li>
                    </ul>
                </div>

                @if(session('error'))
                <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center text-red-800">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            element.setSelectionRange(0, 99999);
            
            try {
                document.execCommand('copy');
                
                // Show feedback
                const btn = event.target;
                const originalText = btn.innerHTML;
                btn.innerHTML = '✅ Copied!';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                }, 2000);
            } catch (err) {
                alert('Gagal copy ke clipboard');
            }
        }
    </script>

</body>
</html>
