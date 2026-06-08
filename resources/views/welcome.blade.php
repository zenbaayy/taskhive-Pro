<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskHive Pro - Smart Task Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #0f172a; color: white; overflow-x: hidden; }

        /* Navbar */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 80px; border-bottom: 1px solid rgba(255,255,255,0.08); position: sticky; top: 0; background: rgba(15,23,42,0.95); backdrop-filter: blur(10px); z-index: 100; }
        .logo { display: flex; align-items: center; gap: 10px; }
        .logo-icon { width: 36px; height: 36px; background: linear-gradient(135deg, #3b82f6, #6366f1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .logo-text { font-size: 20px; font-weight: 700; color: white; }
        .nav-links { display: flex; align-items: center; gap: 24px; }
        .nav-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: white; }
        
        /* Auth Buttons */
        .btn-primary { background: linear-gradient(135deg, #3b82f6, #6366f1); color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: opacity 0.2s; }
        .btn-primary:hover { opacity: 0.9; }
        .btn-outline { color: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.2); padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; transition: background 0.2s; }
        .btn-outline:hover { background: rgba(255,255,255,0.05); color: white; }

        /* Hero Layout */
        .hero { text-align: center; padding: 90px 20px 60px; background: radial-gradient(ellipse at 50% 0%, rgba(99,102,241,0.18) 0%, transparent 70%); }
        .hero-badge { display: inline-block; background: rgba(99,102,241,0.15); border: 1px solid rgba(99,102,241,0.3); color: #a5b4fc; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 500; margin-bottom: 24px; }
        .hero h1 { font-size: 56px; font-weight: 800; line-height: 1.15; margin-bottom: 20px; letter-spacing: -0.02em; }
        .hero h1 span { background: linear-gradient(135deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 16px; color: rgba(255,255,255,0.6); max-width: 620px; margin: 0 auto 40px; line-height: 1.6; }

        /* Dual Choice Decision Grid (Individual vs Team) */
        .decision-container { max-width: 850px; margin: 0 auto 60px; padding: 0 20px; }
        .decision-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 28px; text-align: left; }
        .decision-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 32px; transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s; position: relative; display: flex; flex-direction: column; justify-content: space-between; }
        .decision-card:hover { border-color: rgba(99,102,241,0.5); transform: translateY(-5px); box-shadow: 0 12px 40px -12px rgba(99,102,241,0.25); }
        
        .card-meta { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .card-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .card-badge { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 4px 10px; border-radius: 12px; }
        
        .decision-card h3 { font-size: 22px; font-weight: 700; margin-bottom: 10px; color: white; }
        .decision-card p { font-size: 14px; color: rgba(255,255,255,0.5); line-height: 1.6; margin-bottom: 28px; }
        .card-action-btn { width: 100%; text-align: center; padding: 12px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 600; display: inline-block; transition: background 0.2s, transform 0.1s; }
        
        /* Specific Styles for Split Flows */
        .indiv-theme .card-icon { background: rgba(59,130,246,0.15); color: #3b82f6; }
        .indiv-theme .card-badge { background: rgba(59,130,246,0.1); color: #60a5fa; }
        .indiv-theme .card-action-btn { background: rgba(255,255,255,0.06); color: white; border: 1px solid rgba(255,255,255,0.1); }
        .indiv-theme .card-action-btn:hover { background: rgba(255,255,255,0.12); }
        
        .team-theme .card-icon { background: rgba(139,92,246,0.15); color: #8b5cf6; }
        .team-theme .card-badge { background: rgba(139,92,246,0.1); color: #c084fc; }
        .team-theme .card-action-btn { background: linear-gradient(135deg, #3b82f6, #6366f1); color: white; }
        .team-theme .card-action-btn:hover { opacity: 0.95; }

        /* Stats Bar */
        .stats-bar { display: flex; justify-content: center; gap: 60px; padding: 30px; border-top: 1px solid rgba(255,255,255,0.06); border-bottom: 1px solid rgba(255,255,255,0.06); margin-bottom: 80px; background: rgba(255,255,255,0.01); }
        .stat-item { text-align: center; }
        .stat-item .num { font-size: 32px; font-weight: 800; background: linear-gradient(135deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-item .label { font-size: 13px; color: rgba(255,255,255,0.5); margin-top: 4px; }

        /* Features */
        .features { padding: 0 80px 80px; }
        .section-title { text-align: center; margin-bottom: 50px; }
        .section-title h2 { font-size: 40px; font-weight: 800; margin-bottom: 12px; }
        .section-title p { color: rgba(255,255,255,0.5); font-size: 16px; }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .feature-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 28px; transition: border-color 0.3s, transform 0.3s; }
        .feature-card:hover { border-color: rgba(99,102,241,0.4); transform: translateY(-4px); }
        .feature-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 16px; }
        .feature-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
        .feature-card p { color: rgba(255,255,255,0.5); font-size: 14px; line-height: 1.6; }

        /* Responsive */
        @media(max-width: 768px) {
            .navbar { padding: 20px 30px; }
            .decision-grid, .features-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 38px; }
            .stats-bar { flex-wrap: wrap; gap: 30px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon">🐝</div>
            <span class="logo-text">TaskHive Pro</span>
        </div>
        <div class="nav-links">
            <a href="#features">Features</a>
            <a href="{{ route('login') }}" class="btn-outline">Log In</a>
            <a href="{{ route('register') }}" class="btn-primary">Sign Up</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-badge">🚀 Workspace Infrastructure Module</div>
        <h1>Organise Your Work.<br><span>Amplify Your Impact.</span></h1>
        <p>Choose your workspace execution environment. Connect instantly as an isolated user or initialize a fully managed enterprise profile.</p>
    </section>

    <div class="decision-container">
        <div class="decision-grid">
            
            <div class="decision-card indiv-theme">
                <div>
                    <div class="card-meta">
                        <div class="card-icon"><i class="fas fa-user"></i></div>
                        <span class="card-badge">Stand-Alone</span>
                    </div>
                    <h3>Individual Portal</h3>
                    <p>Perfect for solo tracking, micro targets, customizable categories, and personalized scheduling matrix optimizations.</p>
                </div>
                <a href="{{ route('register') }}?type=member" class="card-action-btn">
                    Launch Personal Space &rarr;
                </a>
            </div>

            <div class="decision-card team-theme">
                <div>
                    <div class="card-meta">
                        <div class="card-icon"><i class="fas fa-users-gear"></i></div>
                        <span class="card-badge">Admin Controlled</span>
                    </div>
                    <h3>Team Workspace</h3>
                    <p>Designed for corporate projects. Team Admins hold full structure privileges, track system workflow logs, and decide operational roles.</p>
                </div>
                <a href="{{ route('register') }}?type=admin" class="card-action-btn">
                    Deploy Team Space &rarr;
                </a>
            </div>

        </div>
    </div>

    <div class="stats-bar">
        <div class="stat-item">
            <div class="num">Smart</div>
            <div class="label">Auto Overdue Detection</div>
        </div>
        <div class="stat-item">
            <div class="num">AJAX</div>
            <div class="label">Real-time Updates</div>
        </div>
        <div class="stat-item">
            <div class="num">Roles</div>
            <div class="label">Admin Decided Access</div>
        </div>
        <div class="stat-item">
            <div class="num">Charts</div>
            <div class="label">Progress Analytics</div>
        </div>
    </div>

    <section class="features" id="features">
        <div class="section-title">
            <h2>System Capabilities</h2>
            <p>High performance task processing options for modern teams</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(59,130,246,0.2); color: #3b82f6;">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3>Task Management</h3>
                <p>Create, assign, and track tasks with priorities, categories, deadlines, and file attachments.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(99,102,241,0.2); color: #6366f1;">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Team Collaboration</h3>
                <p>Create teams, add members, assign tasks, and monitor individual progress in real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background: rgba(16,185,129,0.2); color: #10b981;">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3>Analytics Dashboard</h3>
                <p>Visual charts showing completion rates, progress tracking, and productivity insights.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2026 TaskHive Pro — BS Software Engineering Project | COMSATS University Islamabad, Vehari Campus</p>
    </footer>

</body>
</html>