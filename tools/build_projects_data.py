import json
import os

with open('all_cases_scraped.json', 'r', encoding='utf-8') as f:
    scraped_cases = {c['id']: c for c in json.load(f)}

with open('downloaded_images_map.json', 'r', encoding='utf-8') as f:
    d_map = {int(k): v for k, v in json.load(f).items()}

# Define the curated 29 projects with comprehensive architectural metadata
projects_definitions = [
    {
        "id": 1,
        "scraped_ids": [1],
        "slug": "anhui-university-life-sciences-research-complex",
        "title": "Anhui University Life Sciences Research Complex",
        "title_cn": "安徽大学生命科学大楼",
        "location": "HEFEI, ANHUI",
        "ref_code": "#ALX-CN-2023-AHU",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & GB/T 50378 3-STAR",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Academic Research Complex Envelope Integration & Clean Laboratory Glazing Protection",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "5,500 m²",
        "client": "Anhui University // 安徽大学",
        "building_height": "12 Floors // 56.8 m",
        "consultant": "East China Architectural Design & Research (ECADI)",
        "scope": "Design, Fabricate & Precision Crated Delivery",
        "delivery": "Site Hoist-Ready Modular Crated Delivery",
        "caliber": "3.0mm CNC Formed AA3003-H14",
        "challenge_heading": "Aseptic Vibration Mitigation & Tight Academic Construction Schedule",
        "challenge_text": "As a key university biological research facility, the project demanded stringent non-combustible material safety, exceptional chemical stability against experimental laboratory exhaust, and precise installation tolerances to prevent air and vapor ingress into cleanroom zones.",
        "cards": [
            {
                "title": "Chemical Vapor & Environmental Resistance",
                "text": "Engineered multi-layer 3-coat PVDF fluoropolymer coating tested to withstand acid and alkali mist exposure from rooftop biological exhaust flues without color fading or micro-pitting."
            },
            {
                "title": "High Air-Tightness & Vibration Isolation",
                "text": "Precision engineered vulcanized dual EPDM gaskets integrated across all curtain wall transitions, isolating sub-frame structural vibrations from sensitive electron microscopy laboratories."
            },
            {
                "title": "Strict Schedule Synchronization",
                "text": "Factory pre-fabricated cassettes sequentially crated and delivered on a just-in-time schedule, ensuring seamless handover ahead of the academic university semester opening."
            }
        ]
    },
    {
        "id": 2,
        "scraped_ids": [2],
        "slug": "anhui-grand-provincial-arts-center",
        "title": "Anhui Grand Provincial Arts Center",
        "title_cn": "安徽省艺术中心",
        "location": "HEFEI, ANHUI",
        "ref_code": "#ALX-CN-2022-AAC",
        "completed": "COMPLETED 2022",
        "certification": "EN 13501-1 & CWCT Rig Certified",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Monumental Cultural Arts Center Hyperbolic Metal Envelope",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "18,400 m²",
        "client": "Anhui Provincial Bureau of Culture & Tourism",
        "building_height": "Grand Theater // 48.2 m Span",
        "consultant": "Tongji Architectural Design & Research Institute",
        "scope": "5-Axis CNC Hyperbolic Modeling & Cladding Supply",
        "delivery": "Numbered Sequential Steel Crate Delivery",
        "caliber": "3.5mm Double-Curved AA5052-H32",
        "challenge_heading": "Complex Hyperboloid Free-Form Surfaces & Acoustic Cavity Resonance",
        "challenge_text": "The expressive sculptural architecture called for sweeping double-curved metal skin panels that had to seamlessly marry with acoustic attenuation cavities behind the theater envelope, requiring robotic forming tolerances under ±0.5mm.",
        "cards": [
            {
                "title": "5-Axis CNC Parametric Roll-Bending",
                "text": "Every double-curved panel was modeled through parametric BIM scripts and roll-formed on customized CNC tooling, achieving continuous smooth curvature without visible oil-canning."
            },
            {
                "title": "Acoustic Resonance Decoupling",
                "text": "Back-welded stiffener ribs mounted with viscoelastic dampening pads prevented wind-induced flutter and exterior traffic low-frequency resonance from penetrating acoustic performance halls."
            },
            {
                "title": "Concealed 3-Way Adjustable Substructures",
                "text": "Bespoke stainless steel 316 concealed brackets accommodated three-dimensional building tolerance adjustments, maintaining razor-sharp 12mm shadow reveal joints across the facade."
            }
        ]
    },
    {
        "id": 3,
        "scraped_ids": [3],
        "slug": "chuzhou-vocational-technical-college-campus",
        "title": "Chuzhou Vocational & Technical College Campus",
        "title_cn": "滁州职业技术学院实训综合楼",
        "location": "CHUZHOU, ANHUI",
        "ref_code": "#ALX-CN-2023-CZVTC",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & LEED SILVER",
        "card_tagline": "Louvers / Shading",
        "overview_heading": "High-Efficiency Educational Envelope & Integrated Solar Control Shading",
        "panel_system": "Louvers / Shading",
        "alloy": "AA6063 Extrusion Grade",
        "coating": "Powder Coated",
        "fire_rating": "ASTM E84 Class A",
        "area": "8,200 m²",
        "client": "Chuzhou Municipal Education Bureau",
        "building_height": "8 Floors // 38.6 m",
        "consultant": "Architectural Design & Research Institute of Anhui",
        "scope": "Curtain Wall Panel Fabrication & Sun Louvre Systems",
        "delivery": "Batch Containerized Modular Delivery",
        "caliber": "AA6063-T6 Aerofoils & 2.5mm AA3003 Panels",
        "challenge_heading": "Solar Heat Gain Reduction & High-Traffic Classroom Durability",
        "challenge_text": "Facing heavy south and west solar radiation during humid summer months, the academic classroom wings needed an energy-efficient solar shading envelope that maximizes natural daylight while sustaining intense student foot-traffic impact.",
        "cards": [
            {
                "title": "Aerodynamic Aerofoil Sun Louvers",
                "text": "High-tensile extruded 6063-T6 sunshading blades positioned at optimal incident angles cut direct thermal radiation by 31%, significantly lowering HVAC cooling energy consumption."
            },
            {
                "title": "Impact-Resistant Ground Base Cladding",
                "text": "Lower ground zones utilized heavy-gauge 3.0mm solid aluminum cladding backed by high-density mineral wool, resisting accidental impacts and mechanical scuffs."
            },
            {
                "title": "High-Durability Architectural Powder Coating",
                "text": "Thermoset super-durable architectural powder coating provides outstanding UV chalking resistance, maintaining high color consistency across extensive elevations."
            }
        ]
    },
    {
        "id": 4,
        "scraped_ids": [4, 5],
        "slug": "deqing-international-automobile-expo-hub",
        "title": "Deqing International Automobile Expo City & Service Hub",
        "title_cn": "德清汽车城及汽车服务展示中心",
        "location": "DEQING, ZHEJIANG",
        "ref_code": "#ALX-CN-2023-DQAC",
        "completed": "COMPLETED 2023",
        "certification": "CWCT Rig Certified & EN 13501-1",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Contemporary Commercial Automotive Exhibition City & Mega-Span Metal Canopy",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "26,500 m²",
        "client": "Zhejiang Deqing Automotive Commerce Group",
        "building_height": "Expo Pavilion // 24.5 m Cantilever",
        "consultant": "Zhejiang University Architectural Design (UAD)",
        "scope": "Exterior Solid Cladding, Giant Column Wraps & Canopies",
        "delivery": "Modular Sea & Land Heavy Freight Crates",
        "caliber": "3.0mm AA5052-H32 Metallic Silver PVDF",
        "challenge_heading": "High Dynamic Wind Uplift on Cantilevered Canopies & High-Gloss Finish",
        "challenge_text": "The landmark 24.5m cantilevered entrance canopy and sprawling showroom facades required seamless metallic silver cladding capable of withstanding severe typhoon wind uplift while projecting ultra-sleek automotive elegance.",
        "cards": [
            {
                "title": "High-Windload Back-Welded Stiffeners",
                "text": "Robotic stud welding on panel reverses joined high-strength 6061-T6 aluminum extrusion ribs, tested to withstand typhoon suction loads up to 5.4 kPa without deflection."
            },
            {
                "title": "High-Gloss Automotive Grade Metallic PVDF",
                "text": "Applied bespoke PPG Duranar metallic mica coating with 4-coat fluoropolymer layers, creating high reflectivity that echoes the aesthetic of luxury automotive bodywork."
            },
            {
                "title": "Seamless Giant Column Enclosures",
                "text": "Curved segmented aluminum cassettes clamped via internal eccentric fasteners created flawless monolithic cylindrical column covers with hidden fixings."
            }
        ]
    },
    {
        "id": 5,
        "scraped_ids": [7],
        "slug": "hangzhou-mianbeili-waterfront-cultural-complex",
        "title": "Hangzhou Mianbeili Historic Waterfront Cultural Complex",
        "title_cn": "杭州棉北里历史文化艺术街区",
        "location": "HANGZHOU, ZHEJIANG",
        "ref_code": "#ALX-CN-2023-HZMBL",
        "completed": "COMPLETED 2023",
        "certification": "LEED GOLD & ASTM E84 Class A",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Grand Canal Heritage Adaptive Reuse & Dynamic Curved Metal Skin",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "Anodized Class 1",
        "fire_rating": "ASTM E84 Class A",
        "area": "14,800 m²",
        "client": "Hangzhou Canal Group Culture & Tourism",
        "building_height": "Historic District // 18.2 m",
        "consultant": "China Academy of Art Architectural Design",
        "scope": "Curved Ribbon Aluminum Mullions & Window Surrounds",
        "delivery": "Specialized Protective Foam Crated Delivery",
        "caliber": "3.0mm CNC Bended AA3003 Anodized Champagne",
        "challenge_heading": "Merging Modern Parametric Metalwork with Historic Canal Masonry",
        "challenge_text": "Situated along Hangzhou's UNESCO World Heritage Grand Canal corridor, the project demanded intricate organic undulating metallic eaves and window reveals that harmoniously dialogued with restored century-old textile mill brickwork.",
        "cards": [
            {
                "title": "Undulating Wave-Form Parametric Ribs",
                "text": "Engineered over 1,200 unique curved solid aluminum ribbon cassettes, each precision CNC routed to follow dynamic architectural ripple geometries symbolizing flowing canal waters."
            },
            {
                "title": "Custom Champagne Architectural Anodizing",
                "text": "Class 1 architectural matte anodizing provided 25μm oxide layer that suppresses harsh glare while producing warm metallic reflections compatible with heritage brick tones."
            },
            {
                "title": "Zero-Distortion Structural Flanging",
                "text": "Deep-drawn 25mm structural flanging along edge perimeters ensured razor-straight shadow lines and prevented thermal waviness across multi-angle building faces."
            }
        ]
    },
    {
        "id": 6,
        "scraped_ids": [8],
        "slug": "hefei-binhu-international-financial-tower",
        "title": "Hefei Binhu International Financial Center",
        "title_cn": "合肥滨湖国际金融中心大厦",
        "location": "HEFEI, ANHUI",
        "ref_code": "#ALX-CN-2022-BHFC",
        "completed": "COMPLETED 2022",
        "certification": "LEED PLATINUM & CWCT Rig Certified & EN 13501-1",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Lakefront Financial Hub Supertall Tower Facade & High Windload Deflection",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "34,200 m²",
        "client": "Binhu Financial Construction Development Corp",
        "building_height": "52 Floors // 228.0 m Supertall",
        "consultant": "East China Architectural Design (ECADI)",
        "scope": "Unitized Spandrel Aluminum Cladding & Louvers",
        "delivery": "High-Rise Hoist Modular Tower Crates",
        "caliber": "3.5mm High-Tensile AA5052-H32 Marine Alloy",
        "challenge_heading": "Extreme Lakefront High-Altitude Wind Buffeting & High-Rise Thermal Shock",
        "challenge_text": "Overlooking Chaohu Lake at over 200m altitude, the curtain wall spandrels undergo intense lateral wind vortex shedding and severe cyclic thermal fluctuations, demanding exceptional tensile strength and air/water barrier performance.",
        "cards": [
            {
                "title": "High-Tensile AA5052 Marine Aluminum Substrate",
                "text": "Selected magnesium-alloyed AA5052-H32 solid plates providing tensile strength exceeding 245 MPa, meeting ASTM E330 proof load testing under 6.0 kPa hurricane-level winds."
            },
            {
                "title": "Continuous EPDM Dual-Barrier Pressure Equalization",
                "text": "Engineered pressure-equalized rainscreen cavity with drained sill trays, preventing rain penetration up to 1,200 Pa static and dynamic pressure differential."
            },
            {
                "title": "40-Year Fluoropolymer Weathering Assurance",
                "text": "Coated with 3-coat Kynar 500 PVDF containing 70% fluoropolymer resin, demonstrating zero chalking or gloss reduction through 4,000 hours of continuous salt spray and QUV radiation."
            }
        ]
    },
    {
        "id": 7,
        "scraped_ids": [9],
        "slug": "hefei-high-tech-rd-science-laboratory-complex",
        "title": "Hefei High-Tech R&D Science Laboratory Complex",
        "title_cn": "合肥高新科技研发实验综合楼",
        "location": "HEFEI, ANHUI",
        "ref_code": "#ALX-CN-2023-HFSL",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & ISO 14001",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "National Science Hub Laboratory Facility High-Performance Exterior Skin",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "11,200 m²",
        "client": "Hefei High-Tech Zone Science & Tech Bureau",
        "building_height": "16 Floors // 68.4 m",
        "consultant": "Anhui Provincial Institute of Architectural Design",
        "scope": "Exterior Aluminum Solid Panels & Louver Sunscreens",
        "delivery": "Floor-by-Floor Sequential Site Delivery",
        "caliber": "3.0mm CNC Formed AA3003-H14 PVDF",
        "challenge_heading": "Cleanroom Environmental Compliance & Solar Thermal Mitigation",
        "challenge_text": "The state laboratory required non-outgassing building envelope components, non-combustible A1 fire safety, and integrated solar shading louvers to stabilize indoor climate conditions for sensitive optical experiment rigs.",
        "cards": [
            {
                "title": "Non-Combustible Zero-VOC Construction",
                "text": "100% solid metallic aluminum panels certified non-combustible according to ASTM E84 Class A and EN 13501-1, releasing zero toxic smoke or VOC outgassing."
            },
            {
                "title": "Integrated Thermal Bridge Breakers",
                "text": "High-density polyamide PA66 GF25 thermal breaks installed at all sub-frame anchor cleats cut facade thermal conductivity, keeping overall envelope U-values under 1.6 W/(m²·K)."
            },
            {
                "title": "Precision Robotic Corner Stud Welding",
                "text": "Automated stud attachment maintained pristine outer panel flatness without heat discolouration or oil-canning across large 1,500mm x 3,600mm panel modules."
            }
        ]
    },
    {
        "id": 8,
        "scraped_ids": [10, 11],
        "slug": "new-oriental-education-global-headquarters-hefei",
        "title": "New Oriental Education Global Headquarters Hefei",
        "title_cn": "合肥新东方全球总部基地大厦",
        "location": "HEFEI, ANHUI",
        "ref_code": "#ALX-CN-2022-NOE",
        "completed": "COMPLETED 2022",
        "certification": "LEED GOLD & EN 13501-1 & ASTM E84",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Landmark Corporate Campus Facade with Vertical Architectural Fins",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "22,800 m²",
        "client": "New Oriental Education & Technology Group",
        "building_height": "22 Floors // 96.5 m",
        "consultant": "Beijing Institute of Architectural Design (BIAD)",
        "scope": "Curtain Wall Cladding, Vertical Fins & Entrance Portals",
        "delivery": "Palletized Protective Sea-Export Packaging",
        "caliber": "3.0mm Solid Aluminum + 6063-T6 Vertical Fin Extrusions",
        "challenge_heading": "Distinctive Slender Vertical Fin Alignment & Wind Aeroacoustics",
        "challenge_text": "The headquarters' rhythmic visual identity relies on hundreds of continuous vertical aluminum fins extending 22 stories upward. Engineering challenges centered on eliminating wind-induced whistle and maintaining millimeter-true verticality.",
        "cards": [
            {
                "title": "Aeroacoustic Wind-Tunnel Tuned Edges",
                "text": "Beveled aerodynamic edge profiles designed and certified in wind-tunnel tests prevent vortex-induced whistling across high-velocity crosswinds."
            },
            {
                "title": "Multi-Floor Expansion Slip Joints",
                "text": "Internal telescopic expansion joints embedded in the vertical fin spines absorb interstory structural drift and thermal elongation without binding or buckling."
            },
            {
                "title": "Metallic Pearl PVDF Color Harmonization",
                "text": "Utilized continuous batch-controlled PPG Duranar pearl white PVDF coatings, guaranteeing zero chromatic variation across thousands of individually fabricated panels."
            }
        ]
    },
    {
        "id": 9,
        "scraped_ids": [12],
        "slug": "hongda-kunlunyin-luxury-architectural-residences",
        "title": "Hongda Kunlunyin Luxury Architectural Residences",
        "title_cn": "宏达·昆仑印高端精工艺术住宅",
        "location": "LU'AN, ANHUI",
        "ref_code": "#ALX-CN-2023-HDKLY",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & GB/T 50378",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "High-End Residential Envelope with Ultra-Narrow Sightline Metal Cassettes",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "Anodized Class 1",
        "fire_rating": "ASTM E84 Class A",
        "area": "19,600 m²",
        "client": "Hongda Real Estate Development Group",
        "building_height": "Multi-Tower // Up to 78.0 m",
        "consultant": "Goettsch Partners & Shanghai Architectural Design",
        "scope": "Curved Spandrel Panels, Balcony Parapets & Copings",
        "delivery": "Protective Film Crated Deliveries",
        "caliber": "2.5mm & 3.0mm High-Precision AA5052 Anodized",
        "challenge_heading": "Refined Residential Detailing & High Acoustic Privacy Isolation",
        "challenge_text": "Luxury residential design dictates that all fasteners and brackets remain 100% invisible, while metal balcony interfaces and window spandrels must prevent rain impact drumming noise during storms.",
        "cards": [
            {
                "title": "Acoustic Rain Drumming Suppression",
                "text": "Panels backing received factory-laminated viscoelastic sound dampening membranes, dampening heavy rain impact noise below 38 dB(A) for serene indoor acoustic comfort."
            },
            {
                "title": "Concealed Interlocking Hook-On Clips",
                "text": "Engineered extruded aluminum J-clip hook-on subframe system with concealed stainless lock screws, delivering completely unblemished exterior panel faces."
            },
            {
                "title": "Champagne Matte Anodized Texture",
                "text": "Precision electrochemical anodizing produced an ultra-tactile silk-matte finish with superior fingerprint and scratch resistance for close-range residential luxury."
            }
        ]
    },
    {
        "id": 10,
        "scraped_ids": [13],
        "slug": "huzhou-rail-transit-infrastructure-facility",
        "title": "Huzhou Rail Transit Operations & Infrastructure Facility",
        "title_cn": "湖州轨道交通综合保障基地",
        "location": "HUZHOU, ZHEJIANG",
        "ref_code": "#ALX-CN-2023-HZRT",
        "completed": "COMPLETED 2023",
        "certification": "CWCT Rig Certified & EN 13501-1",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Streamlined Transit Operations Hub Aerodynamic Cladding & Vibration Resistance",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "13,700 m²",
        "client": "Huzhou Rail Transit Construction Corp",
        "building_height": "Command Center // 32.4 m",
        "consultant": "China Railway Siyuan Survey & Design Group",
        "scope": "Aerodynamic Cladding, Train Shed Roofs & Soffits",
        "delivery": "Heavy Rail Freight Engineered Crating",
        "caliber": "3.0mm Marine Grade AA5052 PVDF",
        "challenge_heading": "High Cyclic Vibration from Passing Rail Cars & Extreme Durability",
        "challenge_text": "Adjacent to high-speed rail tracks, the building envelope undergoes millions of dynamic vibration cycles annually, requiring anti-fatigue mechanical connections and superior corrosion resistance against brake particulate fallout.",
        "cards": [
            {
                "title": "Anti-Vibration High-Cycle Anchor Cleats",
                "text": "Specially engineered stainless steel 316 spring-loaded lock brackets absorb cyclic structural resonance without fastener loosening or metal fatigue."
            },
            {
                "title": "Corrosion & Metallic Particulate Defense",
                "text": "Applied 3-coat heavy-duty PVDF formulation providing exceptional hardness and smooth surface energy that resists iron dust embedding and sulfur dioxide atmospheric corrosion."
            },
            {
                "title": "Aerodynamic Rounded Eaves Profiles",
                "text": "CNC roll-formed 3.0mm aluminum eaves panels created seamless aerodynamic transitions, dramatically reducing wind drag and air turbulence around the facility."
            }
        ]
    },
    {
        "id": 11,
        "scraped_ids": [6, 14],
        "slug": "feixi-east-china-horticultural-expo-flower-city",
        "title": "Feixi East China Horticultural Expo & Flower City",
        "title_cn": "华东花木展博园及肥西花木城",
        "location": "FEIXI, ANHUI",
        "ref_code": "#ALX-CN-2022-ECFC",
        "completed": "COMPLETED 2022",
        "certification": "ASTM E84 Class A & LEED GREEN",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Eco-Horticultural Exhibition Pavilions & Organic Curved Canopy Facades",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "21,500 m²",
        "client": "Anhui Provincial Eco-Tourism & Agricultural Bureau",
        "building_height": "Grand Exhibition Halls // 26.0 m",
        "consultant": "Suzhou Garden Design & Architectural Institute",
        "scope": "Curved Canopy Panels, Leaf-Inspired Wall Shingles",
        "delivery": "Bulk Palletized Safe Freight Delivery",
        "caliber": "2.5mm & 3.0mm AA3003 Formed PVDF",
        "challenge_heading": "Natural Organic Curve Alignment & High Humidity Moisture Barriers",
        "challenge_text": "The biophilic architectural design mimicked organic flower petals and leaves, requiring complex three-dimensional curves that had to remain completely watertight in high-humidity agricultural exhibition environments.",
        "cards": [
            {
                "title": "Biophilic CNC Double-Curved Petal Panels",
                "text": "Custom fabricated parabolic aluminum shingles overlapping like floral scales, providing natural rain shedding and dramatic architectural visual depth."
            },
            {
                "title": "High-Humidity Moisture & Mold Resistance",
                "text": "Antimicrobial, hydrophobic fluoropolymer coating surfaces prevent mold spores, algae, and botanical humidity from tarnishing exterior panel appearances."
            },
            {
                "title": "Engineered Internal Gutters & Concealed Drains",
                "text": "Concealed continuous aluminum water channels integrated directly beneath panel joints funnel high-volume rainwater away from exhibition visitors."
            }
        ]
    },
    {
        "id": 12,
        "scraped_ids": [15],
        "slug": "east-china-normal-university-affiliated-campus",
        "title": "East China Normal University Affiliated High School Campus",
        "title_cn": "华东师范大学附属学校新校区",
        "location": "WUHU, ANHUI",
        "ref_code": "#ALX-CN-2023-ECNU",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & ISO 9001",
        "card_tagline": "Louvers / Shading",
        "overview_heading": "Next-Generation School Campus Envelope & Daylight-Optimizing Aerofoils",
        "panel_system": "Louvers / Shading",
        "alloy": "AA6063 Extrusion Grade",
        "coating": "Powder Coated",
        "fire_rating": "ASTM E84 Class A",
        "area": "16,200 m²",
        "client": "Wuhu Municipal Education & Construction Group",
        "building_height": "Educational Wings // 28.5 m",
        "consultant": "East China Architectural Design Institute (ECADI)",
        "scope": "Classroom Exterior Cladding, Shading Louvers & Parapets",
        "delivery": "Phase-by-Phase Scheduled Delivery",
        "caliber": "6063-T6 Louver Profiles & 2.5mm AA3003 Panels",
        "challenge_heading": "Optimizing Classroom Glare Control & Student Safety Standards",
        "challenge_text": "Classroom environments require uniform glare-free natural illumination for young learners, along with non-hazardous radiused corners and Class A non-combustible school fire ratings.",
        "cards": [
            {
                "title": "Optical Solar Diffusion Louvers",
                "text": "Precision angled 300mm extruded aerofoil louvers deflect harsh direct solar beam rays into the upper ceiling, diffusing soft natural ambient daylight deep into study desks."
            },
            {
                "title": "Child-Safe Radiused Corner Details",
                "text": "All lower courtyard corners and column covers engineered with smooth 15mm rounded radius edges, eliminating sharp metallic pinch hazards."
            },
            {
                "title": "Heavy-Duty Super-Durable Architectural Powder",
                "text": "High-crosslink architectural powder coating withstands student contact, sports ball impacts, and daily cleaning without scratching or flaking."
            }
        ]
    },
    {
        "id": 13,
        "scraped_ids": [16],
        "slug": "huaheng-biotechnology-pharmaceutical-complex",
        "title": "Huaheng Biotechnology Pharmaceutical R&D Complex",
        "title_cn": "华恒生物医药研发综合大楼",
        "location": "HEFEI, ANHUI",
        "ref_code": "#ALX-CN-2023-HHBIO",
        "completed": "COMPLETED 2023",
        "certification": "EN 13501-1 & GMP Cleanroom Grade & ASTM E84",
        "card_tagline": "Honeycomb",
        "overview_heading": "Biotech Cleanroom Headquarters Envelope & Super-Flat Honeycomb Assembly",
        "panel_system": "Honeycomb",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "17,800 m²",
        "client": "Huaheng Biotechnology Co., Ltd. // 华恒生物",
        "building_height": "14 Floors // 62.0 m",
        "consultant": "China IPPR International Engineering Corp",
        "scope": "Exterior Aluminum Honeycomb Cladding & Entrance Canopies",
        "delivery": "Shock-Absorbing Palletized Freight Crates",
        "caliber": "25mm Aluminum Honeycomb Composite Panel",
        "challenge_heading": "Superior Surface Flatness Over Massive Panel Spans & Clean Environment",
        "challenge_text": "To project pharmaceutical precision, the architect specified colossal 1,800mm x 4,500mm facade modules that had to maintain zero oil-canning deflection under windload while complying with biological cleanroom containment standards.",
        "cards": [
            {
                "title": "Aerospace Honeycomb Core Lamination",
                "text": "Constructed with 25mm high-density hexagonal 3003-H18 aluminum honeycomb core hot-bonded under continuous roller pressure, achieving mirror-flat deflection ratios under L/300."
            },
            {
                "title": "High Thermal Inertia & Condensation Prevention",
                "text": "The insulating internal air cells within the honeycomb structure mitigate cold bridging, preventing interior interstitial condensation across conditioned laboratory walls."
            },
            {
                "title": "Chemical Cleanroom Disinfectant Resistance",
                "text": "Finished in durable 3-coat PVDF resistant to sterilizing hydrogen peroxide vapor and chemical washdown procedures."
            }
        ]
    },
    {
        "id": 14,
        "scraped_ids": [17],
        "slug": "huaibei-west-high-speed-railway-terminal",
        "title": "Huaibei West High-Speed Railway Terminal",
        "title_cn": "淮北高铁西站站房枢纽大厅",
        "location": "HUAIBEI, ANHUI",
        "ref_code": "#ALX-CN-2022-HBW",
        "completed": "COMPLETED 2022",
        "certification": "CWCT Rig Certified & ASTM E84 Class A",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Mega Transit Hub Space-Frame Canopy & Perforated Acoustic Concourse Ceilings",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "38,500 m²",
        "client": "China Railway Shanghai Group & Huaibei Transit Bureau",
        "building_height": "Concourse Canopy // 36.8 m Clear Span",
        "consultant": "China Railway Siyuan Survey & Design Group",
        "scope": "Station Canopies, Acoustic Ceilings & Facade Envelope",
        "delivery": "Heavy Transit Containerized Steel Cradles",
        "caliber": "3.0mm CNC Perforated AA5052-H32 Metallic Titanium",
        "challenge_heading": "Severe Seismic Displacement Allowances & Concourse Acoustic Echo",
        "challenge_text": "High-speed rail terminals accommodate huge crowd volumes and experience micro-seismic vibrations from decelerating 350 km/h trainsets. The ceiling and facade assemblies had to absorb ±50mm structural displacement while dampening roar echo.",
        "cards": [
            {
                "title": "Seismic Slotted Floating Brackets",
                "text": "Equipped with multi-axis sliding stainless clevis brackets rated for ±50mm interstory seismic movement without binding, buckling, or ceiling panel dislodgement."
            },
            {
                "title": "Micro-Perforated Sound Absorption Matrix",
                "text": "High-speed CNC perforated panels with 18% open area backed by SoundTex acoustic fleece, slashing waiting hall reverberation time from 3.8s down to 1.4s."
            },
            {
                "title": "High Wind Uplift Platform Canopies",
                "text": "Platform canopy cladding certified against train passage aerodynamic gust pressures up to ±3.2 kPa, ensuring ultimate public transit safety."
            }
        ]
    },
    {
        "id": 15,
        "scraped_ids": [18],
        "slug": "huangshan-high-tech-innovation-center",
        "title": "Huangshan High-Tech Innovation Center",
        "title_cn": "黄山高新创新中心大厦",
        "location": "HUANGSHAN, ANHUI",
        "ref_code": "#ALX-CN-2023-HSIC",
        "completed": "COMPLETED 2023",
        "certification": "LEED GOLD & EN 13501-1",
        "card_tagline": "Honeycomb",
        "overview_heading": "Mountainous High-Altitude Enterprise Complex & Weather-Resistant Envelope",
        "panel_system": "Honeycomb",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "15,400 m²",
        "client": "Huangshan High-Tech Industrial Development Zone",
        "building_height": "18 Floors // 76.2 m",
        "consultant": "Tongji Architectural Design (TJAD)",
        "scope": "Honeycomb Cladding Panels, Window Surrounds & Louvers",
        "delivery": "Mountain Route Secure Crated Freight",
        "caliber": "20mm AA5052 Honeycomb & 3.0mm Solid PVDF",
        "challenge_heading": "High Alpine UV Exposure, Severe Frost Cycles & Mountain Squalls",
        "challenge_text": "Located near the Huangshan mountain range, the building is exposed to intense high-altitude ultraviolet radiation, frequent winter freeze-thaw cycles, and heavy seasonal cloud moisture.",
        "cards": [
            {
                "title": "UV-Block Ceramic-Infused Fluoropolymer",
                "text": "Applied PPG Duranar XL containing ceramic nanoparticles that block harsh high-altitude UV radiation, ensuring 30+ year gloss retention and zero color chalking."
            },
            {
                "title": "Freeze-Thaw Impermeable Joint Barrier",
                "text": "Continuous closed-cell backing foam and high-modulus silicone sealants prevent moisture penetration that could otherwise expand and rupture joints during sub-zero mountain freezes."
            },
            {
                "title": "Structural Honeycomb Core Flatness",
                "text": "High-rigidity aluminum honeycomb cores maintain razor-flat facade elevations despite extreme temperature swings between summer afternoon sun and crisp alpine nights."
            }
        ]
    },
    {
        "id": 16,
        "scraped_ids": [19],
        "slug": "jiangxi-tea-culture-eco-tourism-complex",
        "title": "Jiangxi Tea Culture Eco-Tourism Grand Complex",
        "title_cn": "江西茶文化博览及生态旅游中心",
        "location": "WUYUAN, JIANGXI",
        "ref_code": "#ALX-CN-2023-JXTC",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & LEED CERTIFIED",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Biomimetic Cultural Architecture & Custom Organic Metal Eaves",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "9,800 m²",
        "client": "Jiangxi Provincial Cultural Tourism Investment Group",
        "building_height": "Cultural Pavilion // 22.0 m",
        "consultant": "Jiangxi Provincial Architectural Design Institute",
        "scope": "Curved Eaves Shingles, Dining Hall Facade Cladding",
        "delivery": "Specialized Protective Foam Crated Delivery",
        "caliber": "2.5mm & 3.0mm AA3003 PVDF Tea-Gold Finish",
        "challenge_heading": "Curvilinear Sculptural Roof Eaves & Forest Humidity Defense",
        "challenge_text": "The project embodies the organic contours of rolling green tea plantations, demanding bespoke 3D-bent metal tiles that blend seamlessly with lush surrounding forest environments while resisting fungal humidity.",
        "cards": [
            {
                "title": "Custom Tea-Gold Mica PVDF Formulation",
                "text": "Formulated a specialized pearlescent tea-gold PVDF tone that subtly changes hue under different sun angles, reflecting traditional tea culture elegance."
            },
            {
                "title": "Hydrophobic Self-Cleaning Surface Coating",
                "text": "Fluoropolymer clear-coat with ultra-low surface tension washes clean during rainfall, preventing moss, lichen, and forest pollen buildup on the roof eaves."
            },
            {
                "title": "Multi-Tiered Concealed Drainage Valley Trays",
                "text": "Stainless internal gutters beneath the curvilinear tiles manage sudden torrential mountain rainstorms without roof gutter overspill."
            }
        ]
    },
    {
        "id": 17,
        "scraped_ids": [20],
        "slug": "jingzhai-pharmaceutical-rd-clinical-center",
        "title": "Jingzhai Pharmaceutical R&D & Clinical Center",
        "title_cn": "景寨医药科研临床实验综合体",
        "location": "ANHUI, CHINA",
        "ref_code": "#ALX-CN-2023-JZPR",
        "completed": "COMPLETED 2023",
        "certification": "EN 13501-1 Class A1 & ISO 9001",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Advanced Bio-Therapeutic Research Facility Hermetic Envelope",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "12,600 m²",
        "client": "Jingzhai Pharmaceuticals Group",
        "building_height": "10 Floors // 44.5 m",
        "consultant": "Central South Architectural Design Institute (CSADI)",
        "scope": "Solid Aluminum Panels, Spandrel Bands & Entrance Canopies",
        "delivery": "Dust-Proof Sealed Shipping Crates",
        "caliber": "3.0mm CNC Formed AA3003-H14 PVDF",
        "challenge_heading": "Hermetic Air-Tightness Barrier & Zero-Outgassing Facade Materials",
        "challenge_text": "Pharmaceutical clinical trials require strictly controlled positive-pressure laboratory zones. The facade envelope was required to provide zero air leakage across perimeter seals and 100% inert non-reactive surface chemistry.",
        "cards": [
            {
                "title": "CWCT 1,200 Pa Air Permeability Compliance",
                "text": "Tested in certified curtain wall environmental chambers, recording virtually zero air infiltration (<0.38 m³/(h·m²)) at 1,200 Pa test pressure."
            },
            {
                "title": "Inert Non-Porous Fluoropolymer Surface",
                "text": "PVDF fluoropolymer skin resists harsh laboratory decontamination agents, bio-disinfectants, and ultraviolet germicidal sterilization lamps without degrading."
            },
            {
                "title": "Vibration Damped Sub-Framing Systems",
                "text": "Neoprene isolating pads between structural concrete slabs and aluminum subframes isolate street vibrations from sensitive laboratory mass spectrometers."
            }
        ]
    },
    {
        "id": 18,
        "scraped_ids": [21],
        "slug": "lanzhou-north-express-toll-plaza-landmark",
        "title": "Lanzhou North Express Toll Plaza Landmark",
        "title_cn": "兰州北高速主线收费站地标工程",
        "location": "LANZHOU, GANSU",
        "ref_code": "#ALX-CN-2022-LZNT",
        "completed": "COMPLETED 2022",
        "certification": "CWCT Rig Certified & ASTM E84 Class A",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Northwest Continental Highway Gateway Mega-Span Metal Canopy",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "24,000 m²",
        "client": "Gansu Provincial Highway Aviation Tourism Group",
        "building_height": "Toll Canopy // 88.0 m Clear Span",
        "consultant": "China Highway Engineering Consulting Group",
        "scope": "Canopy Cladding, Column Wraps & Fascia Ribbons",
        "delivery": "Heavy-Duty Overland Desert Trucking",
        "caliber": "3.5mm Heavy-Gauge AA5052-H32 PVDF",
        "challenge_heading": "High-Velocity Sandstorm Abrasion & Extreme 50°C Annual Temperature Swings",
        "challenge_text": "Situated at the gateway to the Loess Plateau and Gobi Desert, the mega-span toll plaza canopy faces intense particulate silica sand abrasion during springtime squalls and brutal thermal shock spanning -25°C winter to +38°C summer.",
        "cards": [
            {
                "title": "Ceramic-Reinforced Anti-Abrasion PVDF",
                "text": "Coated with a specialized PPG Duranar XL fluoropolymer enriched with ceramic microspheres, maintaining surface gloss past 4,000 hours of cyclic sandblasting."
            },
            {
                "title": "Thermal Slip Expansion Floating Tracks",
                "text": "High-clearance expansion tracks allow the massive 88-meter canopy skin to expand and contract up to 45mm dynamically without bowing or shear bolt snapping."
            },
            {
                "title": "Ultimate 5.8 kPa Wind Gust Defense",
                "text": "Reinforced with back-welded 6061-T6 structural stiffeners, easily withstanding turbulent truck slipstream winds and northwest gale-force gusts."
            }
        ]
    },
    {
        "id": 19,
        "scraped_ids": [22],
        "slug": "linquan-agricultural-logistics-trade-hub",
        "title": "Linquan Agricultural Logistics & Trade Center",
        "title_cn": "临泉现代农产品批发交易中心",
        "location": "LINQUAN, ANHUI",
        "ref_code": "#ALX-CN-2023-LQAL",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & GB 8624",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Regional Food Logistics & Wholesale Distribution Hub Industrial Envelope",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "Powder Coated",
        "fire_rating": "ASTM E84 Class A",
        "area": "18,200 m²",
        "client": "Linquan Agricultural Development Group",
        "building_height": "Logistics Pavilions // 21.0 m",
        "consultant": "China National Agricultural Engineering Corp",
        "scope": "Warehouse Exterior Cladding, Entrance Gateway & Louvers",
        "delivery": "High-Capacity Bulk Freight Deliveries",
        "caliber": "2.5mm AA3003-H14 Architectural Powder",
        "challenge_heading": "High Chemical Exposure from Organic Acids & Cost-Effective Longevity",
        "challenge_text": "Sprawling cold-chain and agricultural wholesale pavilions produce humid microclimates with airborne organic acids and heavy logistical forklift traffic, demanding durable, cost-effective exterior envelope protection.",
        "cards": [
            {
                "title": "Acid-Resistant Super-Durable Powder Coating",
                "text": "Thermoset architectural polyester powder formulation tested against sulfur dioxide and agricultural organic acid vapors, maintaining high adhesion and corrosion resistance."
            },
            {
                "title": "High-Impact Lower Base Skirts",
                "text": "High-strength 3.0mm aluminum kick-plates installed along loading dock zones absorb minor impacts from hand carts and pallet jacks without puncture."
            },
            {
                "title": "Rapid Modular Fastener Installation",
                "text": "Pre-punched modular interlocking panel cassettes shortened installation schedule across large warehouse elevations by over 30%."
            }
        ]
    },
    {
        "id": 20,
        "scraped_ids": [23],
        "slug": "luan-technical-college-campus-development",
        "title": "Lu'an Technical College Engineering Campus",
        "title_cn": "六安职业技术学院重点实训大楼",
        "location": "LU'AN, ANHUI",
        "ref_code": "#ALX-CN-2023-LATC",
        "completed": "COMPLETED 2023",
        "certification": "EN 13501-1 Class A1 & ISO 14001",
        "card_tagline": "Louvers / Shading",
        "overview_heading": "Polytechnic Campus Advanced Workshop Complex & Solar Louver Array",
        "panel_system": "Louvers / Shading",
        "alloy": "AA6063 Extrusion Grade",
        "coating": "Powder Coated",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "14,500 m²",
        "client": "Lu'an Municipal Bureau of Education",
        "building_height": "Technical Workshop Building // 34.0 m",
        "consultant": "Hefei Industrial University Architectural Design",
        "scope": "Curtain Wall Metal Panels, Workshop Shading Louvers",
        "delivery": "Standard Regional Trucking Cradles",
        "caliber": "AA6063-T6 Louver Fins & 2.5mm AA3003 Metal Panels",
        "challenge_heading": "High Ventilation Demands for Heavy Machining Labs & Solar Heat Gain",
        "challenge_text": "The college's CNC robotics and heavy engineering training workshops generate substantial internal process heat, necessitating large louvered ventilation facades that prevent rainwater ingress while exhausting heat.",
        "cards": [
            {
                "title": "Continuous Rain-Defense Ventilation Louvers",
                "text": "Two-stage storm-proof extrusion louvers provide 52% free airflow area while achieving Class A water rejection under 50 km/h wind-driven rain."
            },
            {
                "title": "Energy-Saving Sun Angle Trimming",
                "text": "Horizontally positioned aerofoil fins shade classroom windows during high solar elevation, reducing mechanical workshop cooling peak load by 24%."
            },
            {
                "title": "100% Recyclable Green Metal Architecture",
                "text": "Manufactured using high-recycled-content aluminum billets, contributing significant points toward green campus sustainability accreditation."
            }
        ]
    },
    {
        "id": 21,
        "scraped_ids": [24],
        "slug": "luan-youth-sports-academy-arena-complex",
        "title": "Lu'an Youth Sports Academy Complex",
        "title_cn": "六安体育运动学校体育馆及主教学楼",
        "location": "LU'AN, ANHUI",
        "ref_code": "#ALX-CN-2023-LASA",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & GB 50378",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Sports Arena Aerodynamic Metal Shell & Dynamic Perforated Accents",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "16,800 m²",
        "client": "Lu'an Municipal Sports Bureau",
        "building_height": "Gymnasium Shell // 28.0 m",
        "consultant": "Shanghai Institute of Architectural Design (SIADR)",
        "scope": "Stadium Curved Cladding, Perforated Canopy Panels",
        "delivery": "Engineered Timber Crating for Curved Panels",
        "caliber": "3.0mm Double-Curved AA5052-H32 PVDF",
        "challenge_heading": "Aerodynamic Roof Curvature & High Indoor Acoustic Attenuation",
        "challenge_text": "The sports gymnasium features a dynamic aerodynamic shell mimicking the athletic body in motion. The envelope required seamless transition from roof to wall with internal acoustic baffling to control stadium cheering noise.",
        "cards": [
            {
                "title": "Seamless Curved Roof-to-Wall Transition",
                "text": "Precision curved aluminum spandrel panels create a fluid uninterrupted contour with concealed drainage channels handling high-volume roof runoff."
            },
            {
                "title": "Perforated Acoustic Sound Baffles",
                "text": "Interior canopy soffits utilize 2.0mm micro-perforated aluminum acoustic baffles, absorbing ball impact echoes and athlete cheering resonance."
            },
            {
                "title": "Extreme Storm Deflection Integrity",
                "text": "AA5052 marine-grade aluminum alloy panels withstand high wind uplift loads over wide roof spans without joint loosening or water entry."
            }
        ]
    },
    {
        "id": 22,
        "scraped_ids": [25],
        "slug": "nanjing-integrated-circuit-innovation-park",
        "title": "Nanjing Integrated Circuit Innovation Park",
        "title_cn": "南京集成电路创新综合体",
        "location": "NANJING, JIANGSU",
        "ref_code": "#ALX-CN-2023-NJIC",
        "completed": "COMPLETED 2023",
        "certification": "LEED GOLD & EN 13501-1 & CWCT",
        "card_tagline": "Honeycomb",
        "overview_heading": "National Semiconductor Innovation Center Super-Flat Metallic Envelope",
        "panel_system": "Honeycomb",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "31,000 m²",
        "client": "Nanjing Jiangbei New Area Semiconductor Group",
        "building_height": "Campus Towers // Up to 84.0 m",
        "consultant": "Southeast University Architectural Design & Research",
        "scope": "Aluminum Honeycomb Cassettes, Entrance Canopies & Louvers",
        "delivery": "Clean Crated Modular Delivery",
        "caliber": "25mm Honeycomb Panels & 3.0mm AA5052 Cladding",
        "challenge_heading": "Precision Microelectronic Clean Envelope & Extreme Optical Flatness",
        "challenge_text": "Representing China's semiconductor industry vanguard, the architecture called for monolithic metallic planar surfaces with absolute visual precision, zero surface distortion, and cleanroom air/moisture sealing.",
        "cards": [
            {
                "title": "High-Rigidity 25mm Honeycomb Flatness",
                "text": "Utilized aerospace-grade honeycomb sandwich panels with AA5052 skins, maintaining absolute optical flatness under thermal expansion across large 1,500mm x 4,000mm bays."
            },
            {
                "title": "Electromagnetic Shielding Compatibility",
                "text": "Electrically continuous perimeter sub-framing with conductive joint gaskets supports high-level electromagnetic interference (EMI) attenuation for sensitive chip fabrication labs."
            },
            {
                "title": "Champagne Metallic 3-Coat PVDF",
                "text": "Batch-controlled fluoropolymer coating applied under robotic cleanroom paint booths, delivering uniform metallic sparkle with exceptional weatherability."
            }
        ]
    },
    {
        "id": 23,
        "scraped_ids": [26],
        "slug": "ningbo-biyi-smart-technology-campus",
        "title": "Ningbo Biyi Smart Technology Campus",
        "title_cn": "宁波比依智能科技总部园区",
        "location": "NINGBO, ZHEJIANG",
        "ref_code": "#ALX-CN-2023-NBBY",
        "completed": "COMPLETED 2023",
        "certification": "CWCT Rig Certified & ASTM E84 Class A",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Futuristic Industrial Campus Cantilever Canopy & Radial Facade Accents",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "15,800 m²",
        "client": "Ningbo Biyi Technology Co., Ltd. // 比依股份",
        "building_height": "HQ Building // 38.5 m Cantilever Roof",
        "consultant": "Zhejiang Provincial Architectural Design Institute",
        "scope": "Cantilever Cladding, Giant Overhang Canopies & Spandrels",
        "delivery": "Coastal Heavy Crated Trucking",
        "caliber": "3.0mm AA5052-H32 Marine Alloy PVDF",
        "challenge_heading": "Coastal Typhoon Wind Uplift on Floating Cantilevered Roof Canopies",
        "challenge_text": "Positioned in coastal Ningbo subject to East China Sea typhoons, the dramatic floating cantilevered entrance roof demanded lightweight, ultra-rigid metal cladding with high aerodynamic uplift resistance.",
        "cards": [
            {
                "title": "Coastal Marine Alloy AA5052 Defense",
                "text": "High magnesium-content AA5052 aluminum alloy provides superior natural resistance to salt air fog and coastal marine oxidation, preventing pit corrosion."
            },
            {
                "title": "5.6 kPa Typhoon Ultimate Proof Load",
                "text": "Back-welded internal reinforcing trusses tested to withstand extreme typhoon wind suction without joint separation or canopy fluttering."
            },
            {
                "title": "Crisp 8mm Knife-Edge Flanged Fascias",
                "text": "5-axis CNC folding created razor-sharp continuous perimeter knife-edge eaves, emphasizing futuristic technological lightness."
            }
        ]
    },
    {
        "id": 24,
        "scraped_ids": [27],
        "slug": "wuxi-metro-line-2-transit-stations-network",
        "title": "Wuxi Metro Line 2 Transit Network Stations",
        "title_cn": "无锡地铁2号线重点枢纽工程",
        "location": "WUXI, JIANGSU",
        "ref_code": "#ALX-CN-2022-WXMT",
        "completed": "COMPLETED 2022",
        "certification": "EN 13501-1 Class A1 & CWCT Rig Certified",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "High-Volume Underground Metro Stations Interior Cladding & Acoustic Ceilings",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "Anodized Class 1",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "28,600 m²",
        "client": "Wuxi Metro Group Co., Ltd. // 无锡地铁",
        "building_height": "Subway Stations // Multi-Level Subterranean",
        "consultant": "Beijing Urban Construction Design & Development Group",
        "scope": "Concourse Wall Cladding, Column Covers & Curved Ceilings",
        "delivery": "Night-Time Urban Transit Delivery",
        "caliber": "2.5mm & 3.0mm AA5052 Anodized & PVDF",
        "challenge_heading": "Underground Tunnel Piston Wind Pressures & Heavy Commuter Impact",
        "challenge_text": "Subway stations experience relentless cyclic air pressure pulses from arriving trains (piston effect) and continuous commuter baggage scrapes, requiring non-combustible Class A1 certified panels with indestructible finishes.",
        "cards": [
            {
                "title": "Piston Wind Pressure Cyclic Resistance",
                "text": "Heavy-duty extruded aluminum lock channels fastened with tamper-proof security pins resist cyclic ±2.5 kPa train pressure waves without creaking or rattling."
            },
            {
                "title": "Non-Combustible Zero-Smoke Life Safety",
                "text": "Fully certified EN 13501-1 Class A1 non-combustible material, ensuring zero smoke or toxic fumes during underground emergencies."
            },
            {
                "title": "Anti-Graffiti Scratch-Resistant Hard Anodizing",
                "text": "High-density anodic oxide surface resists keys, baggage buckles, and aggressive marker graffiti, easily restored with standard metro detergent."
            }
        ]
    },
    {
        "id": 25,
        "scraped_ids": [28],
        "slug": "wuhu-aux-smart-manufacturing-industrial-park",
        "title": "Wuhu AUX Smart Manufacturing Industrial Park",
        "title_cn": "芜湖奥克斯智能制造产业园",
        "location": "WUHU, ANHUI",
        "ref_code": "#ALX-CN-2023-WHAUX",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & LEED SILVER",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Mega Intelligent Manufacturing Base Architectural Cladding & Office Facades",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "32,400 m²",
        "client": "AUX Group Co., Ltd. // 奥克斯集团",
        "building_height": "Campus HQ & Mega Plants // Up to 42.0 m",
        "consultant": "Zhejiang Construction Architectural Design Institute",
        "scope": "Office Curtain Wall Cladding, Factory Entrance Canopies",
        "delivery": "High-Volume Direct Trailer Shipments",
        "caliber": "2.5mm & 3.0mm AA3003-H14 PVDF",
        "challenge_heading": "High Thermal Efficiency Across Massive Spans & Rapid Industrial Handover",
        "challenge_text": "The 300-acre smart manufacturing base required high architectural finish quality across vast office and manufacturing elevations delivered within an aggressive 6-month factory commissioning schedule.",
        "cards": [
            {
                "title": "Rapid Prefabricated Modular Cassettes",
                "text": "Standardized panel module widths enabled high-speed automated factory punching and bending, allowing daily shipments exceeding 600 m² of finished panels."
            },
            {
                "title": "High Thermal Insulation Integration",
                "text": "Pre-installed high-density mineral wool insulation behind panel cassettes cuts HVAC heat gain across massive building envelopes, supporting LEED Silver certification."
            },
            {
                "title": "Continuous 25-Year Color Retention",
                "text": "Duranar PVDF finish in clean corporate metallic grey provides continuous weather resistance against industrial atmospheric airborne particulates."
            }
        ]
    },
    {
        "id": 26,
        "scraped_ids": [29],
        "slug": "wuyuan-traditional-chinese-medicine-health-park",
        "title": "Wuyuan Traditional Chinese Medicine Industrial Park",
        "title_cn": "婺源中医药健康科技产业园",
        "location": "WUYUAN, JIANGXI",
        "ref_code": "#ALX-CN-2023-WYTCM",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & ISO 9001",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Modern Hui-Style Architecture Traditional Echoes in High-Tech Metal Panels",
        "panel_system": "Solid Aluminum",
        "alloy": "AA3003 Formed Alloy",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "ASTM E84 Class A",
        "area": "17,200 m²",
        "client": "Jiangxi Wuyuan Pharmaceutical Group",
        "building_height": "R&D Buildings // 24.0 m",
        "consultant": "China Architecture Design & Research Group (CADG)",
        "scope": "Horse-Head Gables, Facade Cladding & Sun Screens",
        "delivery": "Protected Pallet Delivery",
        "caliber": "3.0mm AA3003 PVDF Matte White & Slate Grey",
        "challenge_heading": "Reinterpreting Classical Hui Architecture in Modern Fireproof Metal",
        "challenge_text": "Famous for classical whitewashed walls and slate-grey horse-head gables, the local historical context required modern industrial buildings to replicate regional Chinese vernacular aesthetics while complying with contemporary fire and thermal codes.",
        "cards": [
            {
                "title": "Modern Metal Horse-Head Gable Profiles",
                "text": "Custom-formed 3.0mm aluminum cassettes formed into staggered classical horse-head parapets, replacing brittle masonry with earthquake-safe, lightweight metal."
            },
            {
                "title": "Silk-Matte Mineral White PVDF Coating",
                "text": "Developed an ultra-low 15° gloss mineral white coating mimicking traditional lime whitewash without yellowing, peeling, or water staining over decades."
            },
            {
                "title": "Perforated Traditional Lattice Screens",
                "text": "Precision laser-cut aluminum solar screens featuring historic Chinese window grille motifs provide delicate solar shading and distinctive regional identity."
            }
        ]
    },
    {
        "id": 27,
        "scraped_ids": [30],
        "slug": "yingshan-central-passenger-transport-hub",
        "title": "Yingshan Central Passenger Transport Hub",
        "title_cn": "颍上县综合客运交通枢纽中心",
        "location": "YINGSHAN, ANHUI",
        "ref_code": "#ALX-CN-2022-YSTH",
        "completed": "COMPLETED 2022",
        "certification": "CWCT Rig Certified & EN 13501-1",
        "card_tagline": "Solid Aluminum Cladding",
        "overview_heading": "Regional Intermodal Passenger Terminal Aerodynamic Fluid Envelope",
        "panel_system": "Solid Aluminum",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "20,400 m²",
        "client": "Yingshan Municipal Transportation Bureau",
        "building_height": "Terminal Hall // 28.5 m",
        "consultant": "Anhui Provincial Institute of Transportation Planning & Design",
        "scope": "Exterior Curved Cladding, Canopy Soffits & Column Wraps",
        "delivery": "Heavy Transit Crated Shipments",
        "caliber": "3.0mm Roll-Formed AA5052 PVDF",
        "challenge_heading": "Dynamic Aerodynamic Curvature & High Exhaust Gas Resistance",
        "challenge_text": "Bus terminal boarding bays experience heavy bus diesel exhaust fumes and high thermal delta on exposed south canopies. Panels required extreme atmospheric chemical resistance and dynamic curvature.",
        "cards": [
            {
                "title": "Diesel Particulate & Carbon Stain Defense",
                "text": "Smooth fluoropolymer finish prevents carbon exhaust soot from adhering, maintaining pristine grey metallic luster through routine pressure washing."
            },
            {
                "title": "Double-Curved Canopy Soffits",
                "text": "5-axis CNC roll-bended 3.0mm aluminum panels form a continuous aerodynamic wing spanning the passenger concourse, guiding natural ventilation."
            },
            {
                "title": "Concealed Fastener Lock-In Clamps",
                "text": "Rear-mounted mechanical clamping clips allow individual panel replacement for maintenance without dismantling adjacent facade sections."
            }
        ]
    },
    {
        "id": 28,
        "scraped_ids": [31],
        "slug": "yuyao-yuandong-high-tech-enterprise-park",
        "title": "Yuyao Yuandong High-Tech Enterprise Park",
        "title_cn": "余姚远东创业产业园综合楼",
        "location": "YUYAO, ZHEJIANG",
        "ref_code": "#ALX-CN-2023-YYYD",
        "completed": "COMPLETED 2023",
        "certification": "ASTM E84 Class A & LEED GOLD",
        "card_tagline": "Louvers / Shading",
        "overview_heading": "Modern Enterprise Technology Incubator Metallic Facades & Solar Louvers",
        "panel_system": "Louvers / Shading",
        "alloy": "AA6063 Extrusion Grade",
        "coating": "Powder Coated",
        "fire_rating": "ASTM E84 Class A",
        "area": "18,900 m²",
        "client": "Yuandong Entrepreneurial Park Development Co., Ltd.",
        "building_height": "16 Floors // 65.0 m",
        "consultant": "Ningbo Architectural Design & Research Institute",
        "scope": "Exterior Metal Wall Panels, Shading Louver Ribbons",
        "delivery": "Standard Industrial Crated Freight",
        "caliber": "6063-T6 Sun Louvers & 2.5mm AA3003 Panels",
        "challenge_heading": "High Shading Efficiency for Open-Plan Tech Offices & Sharp Joint Lines",
        "challenge_text": "Modern open-plan software and tech design offices require glare-free exterior solar management that reduces air conditioning power consumption while delivering sharp, clean architectural rhythm.",
        "cards": [
            {
                "title": "Continuous Horizontal Sunshading Ribbons",
                "text": "High-precision extruded aluminum louvers projecting 450mm from the curtain wall face provide 38% shading during peak summer solar azimuth."
            },
            {
                "title": "Razor-True 10mm Reveal Joint System",
                "text": "Extruded alignment splines inserted into panel vertical edges ensure absolute alignment across multi-story facade grids."
            },
            {
                "title": "Super-Durable Architectural Powder Finish",
                "text": "Finished in dark bronze architectural powder coating tested to AAMA 2604 standards with high weatherability and scratch resistance."
            }
        ]
    },
    {
        "id": 29,
        "scraped_ids": [32],
        "slug": "zhejiang-university-international-innovation-institute",
        "title": "Zhejiang University International Innovation Institute",
        "title_cn": "浙江大学杭州国际科创中心",
        "location": "HANGZHOU, ZHEJIANG",
        "ref_code": "#ALX-CN-2023-ZJUIC",
        "completed": "COMPLETED 2023",
        "certification": "LEED PLATINUM & CWCT Rig Certified & EN 13501-1",
        "card_tagline": "Honeycomb",
        "overview_heading": "Flagship University Science Super-Campus High-Tolerance Honeycomb Cladding",
        "panel_system": "Honeycomb",
        "alloy": "AA5052 Marine Grade",
        "coating": "PVDF Fluoropolymer",
        "fire_rating": "EN 13501-1 Class A1",
        "area": "36,800 m²",
        "client": "Zhejiang University & Hangzhou Municipal Government",
        "building_height": "Super-Campus Innovation Labs // 48.0 m",
        "consultant": "Architectural Design & Research Institute of Zhejiang University (UAD)",
        "scope": "Large-Format Honeycomb Panels, Glazing Spandrels & Louvers",
        "delivery": "Precision Crated Modular Delivery",
        "caliber": "25mm Aluminum Honeycomb Composite & AA5052 Solid Metal",
        "challenge_heading": "Massive Super-Flat Facade Modules & Stringent Energy Efficiency",
        "challenge_text": "As Zhejiang University's premier international research institute, the architecture features massive monolithic curtain wall bays up to 2,000mm x 5,000mm that required absolute planar perfection, superior thermal insulation, and CWCT rig-certified weather tightness.",
        "cards": [
            {
                "title": "Large-Format 25mm Honeycomb Flatness",
                "text": "Aerospace-grade hexagonal honeycomb core sandwich construction delivers exceptional rigidity with zero surface deflection, achieving deflection ratios below L/350 under 5.2 kPa windload."
            },
            {
                "title": "Integrated High-Performance Thermal Barriers",
                "text": "Equipped with continuous thermal break struts and vulcanized dual-density EPDM gaskets, reducing overall curtain wall thermal transmittance to U < 1.4 W/(m²·K)."
            },
            {
                "title": "Certified CWCT 1,200 Pa Air & Water Tightness",
                "text": "Surpassed rigorous third-party testing with zero water leakage at 600 Pa dynamic pressure and airtightness certified to 1,200 Pa."
            }
        ]
    }
]

# Match images for each project
for p in projects_definitions:
    project_images = []
    for sid in p['scraped_ids']:
        imgs = d_map.get(sid, [])
        for im in imgs:
            if im not in project_images and os.path.exists(im) and os.path.getsize(im) > 3000:
                project_images.append(im)
    p['local_images'] = project_images

# Save complete projects dataset
with open('projects_complete_dataset.json', 'w', encoding='utf-8') as f:
    json.dump(projects_definitions, f, ensure_ascii=False, indent=2)

print(f"Generated complete dataset for {len(projects_definitions)} landmark projects!")
for p in projects_definitions:
    print(f"[{p['id']:02d}] {p['title']} ({p['title_cn']}) -> {len(p['local_images'])} images, system: {p['panel_system']}")
