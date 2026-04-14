<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Echo-Realm</title>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root{--bg:#020207;--panel:#0f0f1e;--surface:#0c0c1a;--b1:rgba(168,85,247,0.12);--b2:rgba(168,85,247,0.32);--text:#ddd9ee;--muted:#6b6087;--a:#a855f7;--a2:#c084fc;--gold:#f59e0b;--red:#ef4444;--green:#10b981}
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--bg);color:var(--text);font-family:'Inter',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 70% 50% at 50% 0%,rgba(168,85,247,0.08),transparent 70%);pointer-events:none}
.card{width:100%;max-width:380px;background:var(--panel);border:1px solid var(--b1);border-radius:4px;padding:2.5rem;position:relative}
.card::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--a),transparent)}
.logo{text-align:center;margin-bottom:2rem}
.logo h1{font-family:'Cinzel',serif;font-size:1.3rem;font-weight:700;letter-spacing:0.08em;background:linear-gradient(135deg,var(--a2),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.logo p{font-family:'Cinzel',serif;font-size:0.6rem;letter-spacing:0.28em;text-transform:uppercase;color:var(--muted);margin-top:0.4rem}
.fg{margin-bottom:1.1rem}
.fl{display:block;font-family:'Cinzel',serif;font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--muted);margin-bottom:0.35rem}
.fi{width:100%;background:var(--surface);border:1px solid var(--b1);color:var(--text);padding:0.65rem 0.9rem;border-radius:2px;font-family:'Inter',sans-serif;font-size:0.84rem;outline:none;transition:border-color 0.2s}
.fi:focus{border-color:var(--b2)}
.fi::placeholder{color:rgba(255,255,255,0.12)}
.row{display:flex;align-items:center;gap:0.5rem;margin-bottom:1.4rem}
.row input[type=checkbox]{accent-color:var(--a);width:14px;height:14px}
.row label{font-size:0.76rem;color:var(--muted);cursor:pointer}
.submit{width:100%;background:linear-gradient(135deg,var(--a),#7c3aed);color:#fff;border:none;padding:0.78rem;border-radius:2px;font-family:'Cinzel',serif;font-size:0.72rem;letter-spacing:0.14em;text-transform:uppercase;cursor:pointer;transition:box-shadow 0.2s}
.submit:hover{box-shadow:0 0 20px rgba(168,85,247,0.3)}
.alert{padding:0.7rem 0.9rem;border-radius:2px;margin-bottom:1rem;font-size:0.76rem}
.alert-danger{background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.2);color:var(--red)}
.back{display:block;text-align:center;margin-top:1.2rem;font-size:0.72rem;color:var(--muted);transition:color 0.2s;text-decoration:none}
.back:hover{color:var(--a2)}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <h1>Echo-Realm</h1>
    <p>Admin Access</p>
  </div>
  <?php if(session('error')): ?><div class="alert alert-danger"><?php echo e(session('error')); ?></div><?php endif; ?>
  <?php if($errors->any()): ?><div class="alert alert-danger"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php endif; ?>
  <form action="<?php echo e(route('admin.login')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="fg">
      <label class="fl">Email Address</label>
      <input type="email" name="email" class="fi" value="<?php echo e(old('email')); ?>" required autofocus placeholder="admin@echo-realm.com">
    </div>
    <div class="fg">
      <label class="fl">Password</label>
      <input type="password" name="password" class="fi" required placeholder="••••••••">
    </div>
    <div class="row">
      <input type="checkbox" name="remember" id="rem">
      <label for="rem">Remember me</label>
    </div>
    <button type="submit" class="submit">Enter Admin Panel</button>
  </form>
  <a href="<?php echo e(route('home')); ?>" class="back">← Return to site</a>
</div>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/echo-realm/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>